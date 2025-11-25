<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check admin
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_name = ? AND admin_pass = ?");
    $stmt->execute([$username, $password]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['user_role'] = 'admin';
        header("Location: admin.php");
        exit;
    }

    // Check professor
    $stmt = $pdo->prepare("SELECT * FROM professors WHERE professor_name = ? AND professor_pass = ?");
    $stmt->execute([$username, $password]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['user_role'] = 'professor';
        header("Location: professor.php");
        exit;
    }

    // Check student
    $stmt = $pdo->prepare("SELECT * FROM students WHERE student_name = ? AND student_pass = ?");
    $stmt->execute([$username, $password]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['user_role'] = 'student';
        header("Location: student.php");
        exit;
    }

    $error = "Invalid credentials.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
