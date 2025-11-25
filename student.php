<?php
session_start();
if ($_SESSION['user_role'] !== 'student') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Student Dashboard</h1>
    <nav>
        <ul>
            <li><a href="view_grades.php">View Grades</a></li>
            <li><a href="view_resources.php">View Resources</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
