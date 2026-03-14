<?php
include("includes/header.php");
include("config/database.php");
include("includes/auth.php");

if($_SESSION['role'] != "admin"){
die("Access denied");
}
?>

<h2>BuildSmart Admin Dashboard</h2>

<ul>

<li><a href="manage_users.php">Manage Users</a></li>

<li><a href="manage_projects.php">Manage Projects</a></li>

<li><a href="manage_reviews.php">Manage Reviews</a></li>

</ul>

<?php include("includes/footer.php"); ?>