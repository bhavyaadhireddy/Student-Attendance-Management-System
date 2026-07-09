<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: view.php");
    exit();
}

$id = (int)$_GET['id'];

$result = $conn->query("SELECT * FROM students WHERE id=$id");

if ($result->num_rows == 0) {
    die("Student not found.");
}

$row = $result->fetch_assoc();

$message = "";

if (isset($_POST['updateStudent'])) {

    $student_name = trim($_POST['student_name']);
    $class = trim($_POST['class']);

    $sql = "UPDATE students
            SET student_name='$student_name',
                class='$class'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: view.php");
        exit();
    } else {
        $message = "Update failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Student</h3>

</div>

<div class="card-body">

<?php

if($message!=""){

echo "<div class='alert alert-danger'>$message</div>";

}

?>

<form method="POST">

<div class="mb-3">

<label class="form-label">Student Name</label>

<input
type="text"
class="form-control"
name="student_name"
value="<?php echo htmlspecialchars($row['student_name']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Class</label>

<input
type="text"
class="form-control"
name="class"
value="<?php echo htmlspecialchars($row['class']); ?>"
required>

</div>

<button
class="btn btn-warning"
name="updateStudent">

Update Student

</button>

<a href="view.php" class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</body>
</html>