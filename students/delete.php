<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/config.php';

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error deleting student: " . $conn->error;
    }

} else {
    header("Location: view.php");
    exit();
}
?>