<?php
include "db.php";

function isValidName($name) {
    return preg_match("/^[a-zA-Z. ]+$/", $name);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPassword($password) {
    return strlen($password) >= 8;
}

function isValidImage($image) {
    $allowedFormats = ["jpeg", "jpg", "png", "gif"];
    $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    return in_array($imageExtension, $allowedFormats) && getimagesize($image['tmp_name']);
}

// AJAX insert queries
$name =$_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$Image = $_FILES["image"];

$response = array();

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

if (!isValidPassword($password)) {
    $response['message'] = "Password should be at least 8 characters long.";
    echo json_encode($response);
    exit;
}

if (!isValidImage($Image)) {
    $response['message'] = "Invalid image format or not a valid image.";
    echo json_encode($response);
    exit;
}

$ImageFileName = $Image['name'];
$ImageType = $Image['type'];
$ImageError = $Image['error'];
$ImageTempName = $Image['tmp_name'];
$ImageNameSeprate = explode('.', $ImageFileName);
$ImageExtention = strtolower(end($ImageNameSeprate));
$ImageFileName = $ImageNameSeprate[0] . date("h_i_sa") . '.' . $ImageExtention;
$upload_image = 'images/' . $ImageFileName;

move_uploaded_file($ImageTempName, $upload_image);

$sql = "INSERT INTO user (name, email, password, img) VALUES ('{$name}', '{$email}', '{$password}', '{$upload_image}')";
$stmt = $conn->prepare($sql);
$result = $stmt->execute();

if ($result) {
    $response['status'] = 1;
    echo json_encode($response);
} else {
    $response['status'] = 0;
    echo json_encode($response);
}

?>
