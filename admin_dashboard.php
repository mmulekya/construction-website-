<?php
session_start();
include("config/database.php");

if($_SESSION['role'] != 'admin'){
    echo "Access denied";
    exit();
}
?>

<h1>Admin Dashboard</h1>

<ul>
<li><a href="manage_users.php">Manage Users</a></li>
<li><a href="manage_projects.php">Manage Projects</a></li>
<li><a href="manage_payments.php">Manage Payments</a></li>
<li><a href="manage_reviews.php">Manage Reviews</a></li>
</ul>