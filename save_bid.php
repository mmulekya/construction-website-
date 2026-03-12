<?php

session_start();

include("config/database.php");

$constructor_id = $_SESSION['user_id'];

$project_id = $_POST['project_id'];
$amount = $_POST['amount'];
$proposal = $_POST['proposal'];

$sql = "INSERT INTO bids (project_id,constructor_id,amount,proposal)
VALUES ('$project_id','$constructor_id','$amount','$proposal')";

if(mysqli_query($conn,$sql)){

header("Location: project_details.php?id=".$project_id);

}else{

echo "Error submitting bid";

}

// notify project owner

$project_sql = "SELECT client_id FROM projects WHERE id='$project_id'";
$project_result = mysqli_query($conn,$project_sql);
$project = mysqli_fetch_assoc($project_result);

$client_id = $project['client_id'];

$message = "A constructor placed a bid on your project.";
$link = "project_details.php?id=".$project_id;

$notify_sql = "INSERT INTO notifications (user_id,message,link)
VALUES ('$client_id','$message','$link')";

mysqli_query($conn,$notify_sql);
?>