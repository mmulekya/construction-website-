<?php
include("../config/database.php");
include("../includes/security.php");
include("../includes/csrf.php");

// Only allow admin users
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("HTTP/1.1 403 Forbidden");
    die("Access denied.");
}

// Example: fetch some site stats securely
$stats = [];

// Total users
$stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
$stmt->execute();
$result = $stmt->get_result();
$stats['total_users'] = $result->fetch_assoc()['total_users'];
$stmt->close();

// Total projects
$stmt = $conn->prepare("SELECT COUNT(*) as total_projects FROM projects");
$stmt->execute();
$result = $stmt->get_result();
$stats['total_projects'] = $result->fetch_assoc()['total_projects'];
$stmt->close();

?>

<?php include("../includes/header.php"); ?>

<h2>Admin Dashboard</h2>

<p>Welcome, Admin!</p>

<h3>Site Statistics</h3>
<ul>
<li>Total Users: <?php echo e($stats['total_users']); ?></li>
<li>Total Projects: <?php echo e($stats['total_projects']); ?></li>
</ul>

<!-- Example: Add form with CSRF token -->
<h3>Admin Actions</h3>
<form method="POST" action="admin_action.php">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <button type="submit">Perform Admin Action</button>
</form>

<?php include("../includes/footer.php"); ?>