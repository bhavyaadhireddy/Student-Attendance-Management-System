<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'includes/config.php';

// Today's Date
$today = date("Y-m-d");

// Total Students
$totalStudents = 0;
$result = $conn->query("SELECT COUNT(*) AS total FROM students");
if ($result) {
    $row = $result->fetch_assoc();
    $totalStudents = $row['total'];
}

// Present Today
$present = 0;
$result = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE attendance_date='$today' AND status='Present'");
if ($result) {
    $row = $result->fetch_assoc();
    $present = $row['total'];
}

// Absent Today
$absent = 0;
$result = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE attendance_date='$today' AND status='Absent'");
if ($result) {
    $row = $result->fetch_assoc();
    $absent = $row['total'];
}

// Attendance Percentage
$totalToday = $present + $absent;

$attendancePercentage = 0;

if ($totalToday > 0) {
    $attendancePercentage = round(($present / $totalToday) * 100, 2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Student Attendance Management System</h2>

<a href="logout.php" class="btn btn-danger">
Logout
</a>

</div>

<div class="alert alert-primary shadow-sm">

<h4>
Welcome, <?php echo $_SESSION['admin']; ?> 👋
</h4>

<p class="mb-0">
Manage students, mark attendance and generate attendance reports from this dashboard.
</p>

</div>

<div class="row mt-4">

<div class="col-md-3 mb-3">

<div class="card text-center shadow border-primary">

<div class="card-body">

<h5>Total Students</h5>

<h1 class="text-primary">
<?php echo $totalStudents; ?>
</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card text-center shadow border-success">

<div class="card-body">

<h5>Present Today</h5>

<h1 class="text-success">
<?php echo $present; ?>
</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card text-center shadow border-danger">

<div class="card-body">

<h5>Absent Today</h5>

<h1 class="text-danger">
<?php echo $absent; ?>
</h1>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card text-center shadow border-warning">

<div class="card-body">

<h5>Attendance %</h5>

<h1 class="text-warning">

<?php echo $attendancePercentage; ?>%

</h1>

</div>

</div>

</div>

</div>

<hr>

<div class="row mt-4">

<div class="col-md-3 mb-3 d-grid">

<a href="students/add.php" class="btn btn-primary btn-lg">

➕ Add Student

</a>

</div>

<div class="col-md-3 mb-3 d-grid">

<a href="students/view.php" class="btn btn-success btn-lg">

👨‍🎓 View Students

</a>

</div>

<div class="col-md-3 mb-3 d-grid">

<a href="attendance/mark.php" class="btn btn-warning btn-lg">

📝 Mark Attendance

</a>

</div>

<div class="col-md-3 mb-3 d-grid">

<a href="attendance/report.php" class="btn btn-info btn-lg text-white">

📊 Attendance Report

</a>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header bg-dark text-white">

System Information

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="35%">Administrator</th>

<td><?php echo $_SESSION['admin']; ?></td>

</tr>

<tr>

<th>Date</th>

<td><?php echo date("d-m-Y"); ?></td>

</tr>

<tr>

<th>Total Students</th>

<td><?php echo $totalStudents; ?></td>

</tr>

<tr>

<th>Attendance Recorded Today</th>

<td><?php echo $totalToday; ?></td>

</tr>

<tr>

<th>Attendance Percentage</th>

<td><?php echo $attendancePercentage; ?>%</td>

</tr>

</table>

</div>

</div>

<div class="text-center mt-4 mb-4">

<p class="text-muted">

Student Attendance Management System © <?php echo date("Y"); ?>

</p>

</div>

</div>

</body>

</html>