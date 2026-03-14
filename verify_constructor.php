<?php
include("includes/security.php");
include("includes/auth.php");
include("config/database.php");

if($_SESSION['role']!="admin"){
die("Access denied");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare(
"UPDATE users SET verified=1 WHERE id=?"
);

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: manage_users.php");
?>