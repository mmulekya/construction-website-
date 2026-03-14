<?php
require_once "includes/security.php";
require_client();
include("config/database.php");
include("includes/auth.php");

$bid_id = intval($_GET['bid_id']);

$stmt = $conn->prepare(
"UPDATE bids SET status='accepted' WHERE id=?"
);

$stmt->bind_param("i",$bid_id);
$stmt->execute();
$stmt->close();

echo "Constructor hired successfully.";
?>

