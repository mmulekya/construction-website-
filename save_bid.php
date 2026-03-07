<?php

session_start();
include("config/database.php");

$constructor_id = $_SESSION['user_id'];
$project_id = $_POST['project_id'];
$price = $_POST['price'];
$proposal = $_POST['proposal'];

$sql = "INSERT INTO bids (project_id,constructor_id,price,proposal)
VALUES ('$project_id','$constructor_id','$price','$proposal')";

if(mysqli_query($conn,$sql)){
echo "Bid submitted successfully!";
}else{
echo "Error: ".mysqli_error($conn);
}

?>