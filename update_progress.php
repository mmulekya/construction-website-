<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

// Only constructors can update
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'constructor'){
    die("Access denied. Only constructors can update progress.");
}

$project_id = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;

// Handle update
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $status = sanitize($_POST['status']);

    $stmt = $conn->prepare("UPDATE projects SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $project_id);
    $stmt->execute();
    $stmt->close();

    echo "<p>Status updated successfully!</p>";
}

// Fetch project details
$stmt = $conn->prepare("SELECT title, status FROM projects WHERE id=?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();
$stmt->close();
?>

<h2>Update Project Progress: <?php echo htmlspecialchars($project['title']); ?></h2>

<form method="POST">
    <label>Current Status: <?php echo htmlspecialchars($project['status']); ?></label>
    <select name="status" required>
        <option value="Pending" <?php if($project['status']=="Pending") echo "selected"; ?>>Pending</option>
        <option value="In Progress" <?php if($project['status']=="In Progress") echo "selected"; ?>>In Progress</option>
        <option value="Completed" <?php if($project['status']=="Completed") echo "selected"; ?>>Completed</option>
        <option value="Cancelled" <?php if($project['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
    </select>
    <button type="submit">Update Status</button>
</form>

<?php include("includes/footer.php"); ?>