<?php
session_start();
if ($_SESSION['user_role'] !== 'professor') {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resource_name = $_POST['resource_name'];
    $resource_type = $_POST['resource_type'];
    $resource_link = $_POST['resource_link'];
    $professor_id = $_POST['professor_id'];

    $stmt = $pdo->prepare("CALL AddResource(?, ?, ?, ?)");
    $stmt->execute([$resource_name, $resource_type, $resource_link, $professor_id]);

    echo "Resource added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Resource</title>
</head>
<body>
    <h1>Add Resource</h1>
    <form method="post" action="">
        <input type="text" name="resource_name" placeholder="Resource Name" required>
        <input type="text" name="resource_type" placeholder="Resource Type" required>
        <input type="url" name="resource_link" placeholder="Resource Link" required>
        <input type="number" name="professor_id" placeholder="Professor ID" required>
        <button type="submit">Add Resource</button>
    </form>
    <a href="professor.php">Back</a>
</body>
</html>
