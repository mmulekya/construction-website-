<?php
include("config/database.php");
include("includes/auth.php");

$project_id = intval($_POST['project_id']);
$amount = intval($_POST['amount']);
$proposal = htmlspecialchars(trim($_POST['proposal']));
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare(
"INSERT INTO bids (project_id,user_id,amount,proposal)
VALUES (?,?,?,?)"
);

$stmt->bind_param("iiis",$project_id,$user_id,$amount,$proposal);
$stmt->execute();
$stmt->close();

header("Location: project_details.php?id=".$project_id);
?>
