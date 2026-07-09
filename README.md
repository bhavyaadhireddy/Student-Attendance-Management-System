STUDENT ATTENDANCE MANAGEMENT SYSTEM

OVERVIEW

The Student Attendance Management System is a web-based application developed to simplify student attendance management. It enables administrators to manage student records, mark attendance, generate attendance reports, and export reports in CSV format. The application is built using PHP, MySQL, Bootstrap, HTML, CSS, and JavaScript.

FEATURES

* Secure Admin Login
* Student Registration
* View Students
* Edit Student Details
* Delete Student Records
* Mark Daily Attendance
* Attendance Report Generation
* Date-wise Attendance Filter
* Export Attendance Report as CSV
* Responsive User Interface
* Dashboard with Attendance Statistics


TECHNOLOGIES USED

* PHP
* HTML5
* CSS3
* JavaScript
* Bootstrap 5
* MySQL
* XAMPP
* Git
* GitHub


PROJECT STRUCTURE

StudentAttendanceSystem/
│
├── assets/
│   ├── css/
│   └── js/
│
├── includes/
│   ├── config.php
│   └── auth.php
│
├── students/
│   ├── add.php
│   ├── view.php
│   ├── edit.php
│   └── delete.php
│
├── attendance/
│   ├── mark.php
│   ├── report.php
│   └── export.php
│
├── dashboard.php
├── login.php
├── logout.php
└── index.php
```
DATABASE

Database Name: `attendance_db`

Tables

* admin
* students
* attendance

INSTALLATION

1. Install XAMPP.
2. Start Apache and MySQL.
3. Copy the project folder into the `htdocs` directory.
4. Create a database named **attendance_db**.
5. Import the SQL file.
6. Open the project in your browser:

   http://localhost/StudentAttendanceSystem/

DEFAULT LOGIN

Username: `admin`
Password:`admin123`

MODULES

* Admin Authentication
* Dashboard
* Student Management
* Attendance Management
* Attendance Reports
* CSV Export

PROJECT OBJECTIVES

* Automate attendance management.
* Reduce manual record keeping.
* Generate attendance reports efficiently.
* Maintain accurate student records.
* Provide a simple and responsive interface.

FUTURE ENHANCEMENTS

* Student Login
* Faculty Login
* QR Code Attendance
* Email Notifications
* PDF Report Generation
* Attendance Analytics Dashboard
* Role-Based Access Control

AUTHOR
     BHAVYA SRI ADHIREDDY
     GitHub: https://github.com/bhavyaadhireddy

LICENSE
      This project is developed for educational and learning purposes.
