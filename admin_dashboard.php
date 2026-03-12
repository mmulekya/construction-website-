<?php
include("includes/header.php");
include("config/database.php");

if($_SESSION['role'] != "admin"){
echo "Access denied";
exit;
}

?>

<h2>Admin Dashboard</h2>

<a href="manage_users.php">Manage Users</a><br><br>

<a href="manage_projects.php">Manage Projects</a><br><br>

<a href="manage_payments.php">Manage Payments</a>

<?php include("includes/footer.php"); ?>