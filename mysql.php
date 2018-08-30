<?php
$server = "localhost";
$name = "root";
$pass = "";
$db = "Gemme2";

$conn = new mysqli($server, $name, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>