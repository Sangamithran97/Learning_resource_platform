<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $course_name = $_POST['course_name'];
        $professor_id = $_POST['professor_id'];
        $course_desc = $_POST['course_desc'];

        $stmt = $pdo->prepare("CALL AddCourse(?, ?, ?)");
        $stmt->execute([$course_name, $professor_id, $course_desc]);

        echo "Course added successfully!";
    } catch (PDOException $e) {
        echo "Error adding course: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
</head>
<body>
    <h1>Add Course</h1>
    <form method="post" action="">
        <input type="text" name="course_name" placeholder="Course Name" required>
        <input type="number" name="professor_id" placeholder="Professor ID" required>
        <textarea name="course_desc" placeholder="Course Description" required></textarea>
        <button type="submit">Add Course</button>
    </form>
    <a href="admin.php">Back</a>
</body>
</html>
