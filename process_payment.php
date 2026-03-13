<?php

include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$user_id = $_SESSION['user_id'];
$project_id = intval($_POST['project_id']);
$amount = floatval($_POST['amount']);
$method = htmlspecialchars($_POST['method']);

$stmt = $conn->prepare(
"INSERT INTO payments (user_id,project_id,amount,method,status)
VALUES (?,?,?,?,?)"
);

$status = "completed";

$stmt->bind_param("iidss",$user_id,$project_id,$amount,$method,$status);

$stmt->execute();

$stmt->close();

header("Location: payment_history.php");

}
?>
