<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor_id = $_POST['professor_id'];
    $professor_name = $_POST['professor_name'];
    $professor_email = $_POST['professor_email'];
    $professor_pass = $_POST['professor_pass'];

    $stmt = $pdo->prepare("CALL AddProfessor(?, ?, ?, ?)");
    $stmt->execute([$professor_id, $professor_name, $professor_email, $professor_pass]);

    echo "Professor added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Professor</title>
</head>
<body>
    <h1>Add Professor</h1>
    <form method="post" action="">
        <input type="number" name="professor_id" placeholder="Professor ID" required>
        <input type="text" name="professor_name" placeholder="Name" required>
        <input type="email" name="professor_email" placeholder="Email (must be @gmail.com)" required>
        <input type="password" name="professor_pass" placeholder="Password" required>
        <button type="submit">Add Professor</button>
    </form>
    <a href="admin.php">Back</a>
</body>
</html>
