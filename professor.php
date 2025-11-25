<?php
session_start();
if ($_SESSION['user_role'] !== 'professor') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Professor Dashboard</title>
</head>
<body>
    <h1>Professor Dashboard</h1>
    <nav>
        <ul>
            <li><a href="add_grade.php">Add Grade</a></li>
            <li><a href="add_resource.php">Add Resource</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
