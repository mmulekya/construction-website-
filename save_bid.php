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

?>