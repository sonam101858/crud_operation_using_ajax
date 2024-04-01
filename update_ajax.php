<?php
// Establish database connection
include "db.php";

function isValidName($name) {
    // You can customize the name validation pattern as needed
    return preg_match("/^[a-zA-Z. ]+$/", $name);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidImage($image) {
    $allowedFormats = ["jpeg", "jpg", "png", "gif"];
    $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    return in_array($imageExtension, $allowedFormats) && getimagesize($image['tmp_name']);
}

$response = array();

$name = $_POST['name']; 
$email = $_POST['email']; 
$image = $_FILES['image'];
$old_image = $_POST['old_image'];

// Perform validation checks
if (!isValidName($name)) {
    $response['message'] = "Invalid name format.";
    echo json_encode($response);
    exit;
}

if (!isValidEmail($email)) {
    $response['message'] = "Invalid email format.";
    echo json_encode($response);
    exit;
}

// Check if a new image is uploaded
if(!empty($_FILES['image']['name'])) {
    // If a new image is uploaded, validate and process it
    if (!isValidImage($image)) {
        $response['message'] = "Invalid image format or not a valid image.";
        echo json_encode($response);
        exit;
    }

    $ImageFileName = $image['name'];
    $ImageType = $image['type'];
    $ImageError = $image['error'];
    $ImageTempName = $image['tmp_name'];
    $ImageNameSeprate = explode('.', $ImageFileName);
    $ImageExtention = strtolower(end($ImageNameSeprate));
    $ImageFileName = $ImageNameSeprate[0] . date("h_i_sa") . '.' . $ImageExtention;
    $upload_image = 'images/' . $ImageFileName;
    
    move_uploaded_file($ImageTempName, $upload_image);
    
    // Delete the old image if it exists
    if (file_exists($old_image)) {
        unlink($old_image);
    }

    // Update image path in the database
    $id = $_POST['id'];
    $sql = "UPDATE user SET name=:name, email=:email, img=:image WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':image', $upload_image);
    $stmt->bindParam(':id', $id);
   
    if ($stmt->execute()) {
        $response['status'] = 1;
        echo json_encode($response);
    } else {
        $response['status'] = 0;
        echo json_encode($response);
    }
} else {
    // If no new image is uploaded, keep the existing image path unchanged
    $id = $_POST['id'];
    $sql = "UPDATE user SET name=:name, email=:email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
   
    if ($stmt->execute()) {
        $response['status'] = 1;
        echo json_encode($response);
    } else {
        $response['status'] = 0;
        echo json_encode($response);
    }
}
?>
