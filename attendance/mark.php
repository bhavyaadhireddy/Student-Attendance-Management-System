<?php
include '../includes/auth.php';
include '../includes/config.php';

$message = "";

$date = isset($_POST['attendance_date'])
    ? $_POST['attendance_date']
    : date("Y-m-d");

// Save Attendance
if(isset($_POST['saveAttendance'])){

    foreach($_POST['status'] as $student_id=>$status){

        // Check duplicate attendance
        $check = $conn->prepare("
            SELECT attendance_id
            FROM attendance
            WHERE student_id=?
            AND attendance_date=?
        ");

        $check->bind_param("is",$student_id,$date);
        $check->execute();

        $result = $check->get_result();

        if($result->num_rows==0){

            $insert=$conn->prepare("
                INSERT INTO attendance
                (student_id,attendance_date,status)
                VALUES(?,?,?)
            ");

            $insert->bind_param(
                "iss",
                $student_id,
                $date,
                $status
            );

            $insert->execute();

        }

    }

    $message="Attendance Saved Successfully!";
}

$students=$conn->query("
SELECT *
FROM students
ORDER BY roll_no
");
?>
<!DOCTYPE html>
<html>

<head>

<title>Mark Attendance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Mark Attendance</h3>

</div>

<div class="card-body">

<?php
if($message!=""){
echo "<div class='alert alert-success'>$message</div>";
}
?>

<form method="POST">

<div class="row mb-3">

<div class="col-md-4">

<label class="form-label">
Attendance Date
</label>

<input
type="date"
name="attendance_date"
value="<?php echo $date;?>"
class="form-control">

</div>

</div>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Roll No</th>

<th>Student Name</th>

<th>Class</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php
while($row=$students->fetch_assoc()){
?>

<tr>

<td><?php echo $row['roll_no'];?></td>

<td><?php echo htmlspecialchars($row['student_name']);?></td>

<td><?php echo htmlspecialchars($row['class']);?></td>

<td>

<div class="form-check form-check-inline">

<input
class="form-check-input"
type="radio"
name="status[<?php echo $row['id'];?>]"
value="Present"
required>

<label class="form-check-label">
Present
</label>

</div>

<div class="form-check form-check-inline">

<input
class="form-check-input"
type="radio"
name="status[<?php echo $row['id'];?>]"
value="Absent">

<label class="form-check-label">
Absent
</label>

</div>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

<button
class="btn btn-success"
name="saveAttendance">

Save Attendance

</button>

<a
href="../dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>