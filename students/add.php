<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include '../includes/config.php';

$message = "";

if(isset($_POST['addStudent'])){

    $roll_no = trim($_POST['roll_no']);
    $student_name = trim($_POST['student_name']);
    $class = trim($_POST['class']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Check if Roll Number already exists
    $check = $conn->query("SELECT id FROM students WHERE roll_no='$roll_no'");

    if($check->num_rows > 0){

        $message = "<div class='alert alert-danger'>
                        Roll Number already exists!
                    </div>";

    }else{

        $sql = "INSERT INTO students
                (roll_no, student_name, class, email, phone)
                VALUES
                ('$roll_no','$student_name','$class','$email','$phone')";

        if($conn->query($sql)){

            $message = "<div class='alert alert-success'>
                            Student Added Successfully.
                        </div>";

        }else{

            $message = "<div class='alert alert-danger'>
                            ".$conn->error."
                        </div>";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Add Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Add Student</h3>

</div>

<div class="card-body">

<?php echo $message; ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Roll Number
</label>

<input
type="text"
name="roll_no"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Student Name
</label>

<input
type="text"
name="student_name"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Class
</label>

<input
type="text"
name="class"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Email
</label>

<input
type="email"
name="email"
class="form-control">

</div>

</div>

<div class="mb-3">

<label class="form-label">
Phone Number
</label>

<input
type="text"
name="phone"
class="form-control">

</div>

<button
type="submit"
name="addStudent"
class="btn btn-primary">

Add Student

</button>

<a href="../dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>