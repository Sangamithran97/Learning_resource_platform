<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $student_id = $_POST['student_id'];
        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $student_pass = password_hash($_POST['student_pass'], PASSWORD_DEFAULT); // Hash the password

        $stmt = $pdo->prepare("CALL AddStudent(?, ?, ?, ?)");
        $stmt->execute([$student_id, $student_name, $student_email, $student_pass]);

        echo "Student added successfully!";
    } catch (PDOException $e) {
        echo "Error adding student: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
</head>
<body>
    <h1>Add Student</h1>
    <form method="post" action="">
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="text" name="student_name" placeholder="Name" required>
        <input type="email" name="student_email" placeholder="Email" required>
        <input type="password" name="student_pass" placeholder="Password" required>
        <button type="submit">Add Student</button>
    </form>
    <a href="admin.php">Back</a>
</body>
</html>
