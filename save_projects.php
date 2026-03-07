<?php

session_start();
include("config/database.php");

$client_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$budget = $_POST['budget'];

$sql = "INSERT INTO projects (client_id,title,description,location,budget)
VALUES ('$client_id','$title','$description','$location','$budget')";

if(mysqli_query($conn,$sql)){
echo "Project posted successfully!";
}else{
echo "Error: ".mysqli_error($conn);
}

?>