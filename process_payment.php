<?php
session_start();
include("config/database.php");

$client_id = $_SESSION['user_id'];
$project_id = $_POST['project_id'];
$constructor_id = $_POST['constructor_id'];
$amount = $_POST['amount'];

$sql = "INSERT INTO payments (project_id, client_id, constructor_id, amount, payment_status)
VALUES ('$project_id','$client_id','$constructor_id','$amount','paid')";

mysqli_query($conn,$sql);

echo "Payment successful!";
?>