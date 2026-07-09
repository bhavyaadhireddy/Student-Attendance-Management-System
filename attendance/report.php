<?php
include '../includes/auth.php';
include '../includes/config.php';

$date = isset($_GET['date']) ? $_GET['date'] : "";

$sql = "SELECT
            attendance.attendance_date,
            attendance.status,
            students.roll_no,
            students.student_name,
            students.class
        FROM attendance
        INNER JOIN students
        ON attendance.student_id = students.id";

if($date != ""){
    $sql .= " WHERE attendance.attendance_date='$date'";
}

$sql .= " ORDER BY attendance.attendance_date DESC, students.roll_no ASC";

$result = $conn->query($sql);

$total = 0;
$present = 0;
$absent = 0;

if($result){
    while($row = $result->fetch_assoc()){

        $total++;

        if($row['status']=="Present"){
            $present++;
        }else{
            $absent++;
        }

        $records[] = $row;
    }
}

$percentage = 0;

if($total>0){
    $percentage = round(($present/$total)*100,2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Attendance Report</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Attendance Report</h3>

</div>

<div class="card-body">

<form method="GET">

<div class="row mb-3">

<div class="col-md-4">

<label class="form-label">

Select Date

</label>

<input
type="date"
name="date"
class="form-control"
value="<?php echo $date; ?>">

</div>

<div class="col-md-2 d-flex align-items-end">

<button
class="btn btn-primary w-100">

Search

</button>

</div>

<div class="col-md-2 d-flex align-items-end">

<a
href="report.php"
class="btn btn-secondary w-100">

Reset

</a>

</div>

<div class="col-md-4 d-flex align-items-end justify-content-end">

<a
href="../dashboard.php"
class="btn btn-success">

Back to Dashboard

</a>
<a
href="export.php"
class="btn btn-primary ms-2">

Export CSV

</a>

</div>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Roll No</th>

<th>Student Name</th>

<th>Class</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

if(!empty($records)){

foreach($records as $row){

?>

<tr>

<td><?php echo htmlspecialchars($row['roll_no']); ?></td>

<td><?php echo htmlspecialchars($row['student_name']); ?></td>

<td><?php echo htmlspecialchars($row['class']); ?></td>

<td><?php echo $row['attendance_date']; ?></td>

<td>
<?php
if($row['status']=="Present"){
?>
<span class="badge bg-success">Present</span>
<?php
}else{
?>
<span class="badge bg-danger">Absent</span>
<?php
}
?>
</td>

</tr>

<?php
}
}else{
?>

<tr>

<td colspan="5" class="text-center">

No attendance records found.

</td>

</tr>

<?php
}
?>

</tbody>

</table>

<hr>

<div class="row text-center">

<div class="col-md-4">

<div class="card border-success">

<div class="card-body">

<h5>Total Records</h5>

<h2><?php echo $total; ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-primary">

<div class="card-body">

<h5>Present</h5>

<h2 class="text-success">

<?php echo $present; ?>

</h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-danger">

<div class="card-body">

<h5>Absent</h5>

<h2 class="text-danger">

<?php echo $absent; ?>

</h2>

</div>

</div>

</div>

</div>

<div class="row mt-4">

<div class="col-md-12">

<div class="card">

<div class="card-body text-center">

<h4>

Attendance Percentage

</h4>

<div class="progress" style="height:30px;">

<div
class="progress-bar bg-success"
role="progressbar"
style="width: <?php echo $percentage; ?>%;">

<?php echo $percentage; ?>%

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>