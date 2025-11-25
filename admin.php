<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="add_professor.php">Add Professor</a></li>
            <li><a href="add_student.php">Add Student</a></li>
            <li><a href="add_course.php">Add Course</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
