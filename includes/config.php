<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "attendance_db";

// Create Connection
$conn = new mysqli($host, $user, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Set Character Encoding
$conn->set_charset("utf8");

?>