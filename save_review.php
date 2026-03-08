<?php
session_start();
include("config/database.php");

$constructor_id = $_POST['constructor_id'];
$project_id = $_POST['project_id'];
$client_id = $_SESSION['user_id'];
$rating = $_POST['rating'];
$review = $_POST['review'];

$sql = "INSERT INTO reviews (constructor_id, client_id, project_id, rating, review)
VALUES ('$constructor_id','$client_id','$project_id','$rating','$review')";

mysqli_query($conn,$sql);

echo "Review submitted successfully!";
?>