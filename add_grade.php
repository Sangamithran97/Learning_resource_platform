<?php
session_start();
if ($_SESSION['user_role'] !== 'professor') {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $professor_id = $_POST['professor_id'];
    $total_marks = $_POST['total_marks'];

    $stmt = $pdo->prepare("CALL AddGrade(?, ?, ?, ?)");
    $stmt->execute([$student_id, $course_id, $professor_id, $total_marks]);

    echo "Grade added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Grade</title>
</head>
<body>
    <h1>Add Grade</h1>
    <form method="post" action="">
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="number" name="course_id" placeholder="Course ID" required>
        <input type="number" name="professor_id" placeholder="Professor ID" required>
        <input type="text" name="total_marks" placeholder="Total Marks" required>
        <button type="submit">Add Grade</button>
    </form>
    <a href="professor.php">Back</a>
</body>
</html>
