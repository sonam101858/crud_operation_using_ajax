<?php
// Database connection parameters
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "crudoperation_ajax";

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
