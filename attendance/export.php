<?php
include '../includes/auth.php';
include '../includes/config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance_report.csv"');

$output = fopen("php://output", "w");

// CSV Header
fputcsv($output, array(
    "Roll No",
    "Student Name",
    "Class",
    "Attendance Date",
    "Status"
));

// Fetch Attendance Records
$sql = "SELECT
            students.roll_no,
            students.student_name,
            students.class,
            attendance.attendance_date,
            attendance.status
        FROM attendance
        INNER JOIN students
        ON attendance.student_id = students.id
        ORDER BY attendance.attendance_date DESC,
                 students.roll_no ASC";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

    fputcsv($output, array(
        $row['roll_no'],
        $row['student_name'],
        $row['class'],
        $row['attendance_date'],
        $row['status']
    ));

}

fclose($output);
exit;
?>