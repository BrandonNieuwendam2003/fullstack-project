<?php
$dbname = "cafe";
$password = "";
$username = 'root';
$servername = 'localhost';
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>