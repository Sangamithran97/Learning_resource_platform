<?php
session_start();
if ($_SESSION['user_role'] !== 'student') {
    header("Location: login.php");
    exit;
}
include 'db.php';

$resource_count_message = '';
$resources = [];
$resources_found = false; // Flag to check if resources were found

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor_id = $_POST['professor_id'];

    // Prepare the stored procedure call
    $stmt = $pdo->prepare("CALL ViewResource(?)");
    $stmt->execute([$professor_id]);
    
    // Fetch the resource count message
    $resource_count_message = $stmt->fetchColumn();

    // Fetch the resources
    $stmt->nextRowset(); // Move to the next result set for resources
    $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if any resources were found
    $resources_found = !empty($resources);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Resources</title>
</head>
<body>
    <h1>View Resources</h1>
    <form method="post" action="">
        <input type="number" name="professor_id" placeholder="Professor ID" required>
        <button type="submit">View Resources</button>
    </form>

    <?php if ($resource_count_message): ?>
        <h2><?php echo htmlspecialchars($resource_count_message); ?></h2>
    <?php endif; ?>

    <?php if ($resources_found): ?>
        <h2>Resources</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Link</th>
                <th>Date</th>
            </tr>
            <?php foreach ($resources as $resource): ?>
            <tr>
                <td><?php echo htmlspecialchars($resource['Name']); ?></td>
                <td><?php echo htmlspecialchars($resource['Type']); ?></td>
                <td><a href="<?php echo htmlspecialchars($resource['Link']); ?>" target="_blank">View</a></td>
                <td><?php echo htmlspecialchars($resource['Date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No resources found for this professor.</p>
    <?php endif; ?>

    <a href="student.php">Back</a>
</body>
</html>
