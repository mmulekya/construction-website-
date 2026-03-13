<?php
session_start();
include("config/database.php");

$user_id = $_SESSION['user_id'];

$title = $_POST['title'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];

move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);

$sql = "INSERT INTO portfolios (user_id,title,description,image)
VALUES ('$user_id','$title','$description','$image')";

mysqli_query($conn,$sql);

header("Location: profile.php");

?>
