<?php
session_start();
include("config/database.php");

$client_id = $_SESSION['user_id'];
$project_id = $_POST['project_id'];
$constructor_id = $_POST['constructor_id'];
$amount = $_POST['amount'];
$method = $_POST['method'];

// Simulate successful payment
$status = "paid";

$sql = "INSERT INTO payments (project_id,client_id,constructor_id,amount,method,status)
VALUES ('$project_id','$client_id','$constructor_id','$amount','$method','$status')";

if(mysqli_query($conn,$sql)){
    echo "<h3>Payment Successful!</h3>";
    echo "<a href='dashboard.php'>Go to Dashboard</a>";
}else{
    echo "Payment failed.";
}

?>