<?php
session_start();
if ($_SESSION['user_role'] !== 'student') {
    header("Location: login.php");
    exit;
}
include 'db.php';

$average_message = '';
$grades = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];

    // Prepare the stored procedure call
    $stmt = $pdo->prepare("CALL ViewGrade(?)");
    $stmt->execute([$student_id]);
    
    // Fetch the average message
    $average_message = $stmt->fetchColumn();

    // Fetch the grades
    $stmt->nextRowset(); // Move to the next result set for grades
    $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Grades</title>
</head>
<body>
    <h1>View Grades</h1>
    <form method="post" action="">
        <input type="number" name="student_id" placeholder="Student ID" required>
        <button type="submit">View Grades</button>
    </form>

    <?php if ($average_message): ?>
        <h2><?php echo htmlspecialchars($average_message); ?></h2>
    <?php endif; ?>

    <?php if (!empty($grades)): ?>
        <h2>Grades</h2>
        <table>
            <tr>
                <th>Course ID</th>
                <th>Marks</th>
                <th>Date</th>
            </tr>
            <?php foreach ($grades as $grade): ?>
            <tr>
                <td><?php echo htmlspecialchars($grade['Course ID']); ?></td>
                <td><?php echo htmlspecialchars($grade['Marks']); ?></td>
                <td><?php echo htmlspecialchars($grade['Date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <a href="student.php">Back</a>
</body>
</html>
