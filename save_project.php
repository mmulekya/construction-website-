<?php
include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$title = htmlspecialchars(trim($_POST['title']));
$description = htmlspecialchars(trim($_POST['description']));
$location = htmlspecialchars(trim($_POST['location']));
$budget = intval($_POST['budget']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare(
"INSERT INTO projects (title,description,location,budget,user_id)
VALUES (?,?,?,?,?)"
);

$stmt->bind_param("sssii",$title,$description,$location,$budget,$user_id);
$stmt->execute();
$stmt->close();

header("Location: projects.php");

}
?>
