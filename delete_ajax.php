<?php 
$user_id = $_POST["id"];
try {
    include "db.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();
    $response = array();

    
    // Fetch the row from the database
    $sql_select = "SELECT * FROM user WHERE id = :user_id";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_select->execute();

   
                 
                if ($stmt_select->rowCount() > 0) 
                {
                        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);

                        // Delete the image file
                        $imageFileName = $row['img'];
                        $directory = __DIR__ . DIRECTORY_SEPARATOR;
                        $filePath = $directory . $imageFileName;

                        // Delete the user record
                        $sql_delete = "DELETE FROM user WHERE id = :user_id";
                        $stmt_delete = $conn->prepare($sql_delete);
                        $stmt_delete->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                       
                        if ($stmt_delete->execute()) 
                        {
                            if (!empty($row['img'])) 
                            {
                                    if (file_exists($filePath)) 
                                    {
                                    if (unlink($filePath)) 
                                    {
                                            $response['message'] = "Record and image file deleted successfully.";
                                            $response['status'] = 1;
                                        
                                            $conn->commit();
                                            echo json_encode($response);
                                            exit;
                                        } 
                                    else 
                                        {
                                            $conn->rollback();
                                            $response['message'] = "Failed to delete the image file.";
                                            $response['status'] = 0;
                                            // throw new Exception("Failed to delete the image file.");
                                            echo json_encode($response);
                                            exit;
                                        }
                                    } 
                                    else  
                                    {
                                        $response['message'] = "Record  deleted successfully.";
                                        $response['status'] = 1;
                                    
                                        $conn->commit();
                                        echo json_encode($response);
                                        exit;
                                    }
                            }
                             else
                            {
                                $response['message'] = "Record is deleted.";
                                $response['status'] = 1;
                                $conn->commit();
                                // throw new Exception("Failed to delete the image file.");
                                 echo json_encode($response);
                                exit;
                            }
                        }
                   } 
             else 
                {
                    $response['message'] = "Record is not deleted.";
                    $response['status'] = 0;
                
                    // throw new Exception("Failed to delete the image file.");
                    echo json_encode($response);
                    exit;
                }

 
} catch (PDOException $e) {
    $conn->rollback();
    $response['message'] = "Error: " . $e->getMessage();
    $response['status'] = 0;
    echo json_encode($response);
    exit;
}
?>
