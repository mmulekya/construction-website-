<?php
include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$sender_id = $_SESSION['user_id'];
$receiver_id = intval($_POST['receiver_id']);
$message = htmlspecialchars(trim($_POST['message']));

$stmt = $conn->prepare(
"INSERT INTO messages (sender_id,receiver_id,message)
VALUES (?,?,?)"
);

$stmt->bind_param("iis",$sender_id,$receiver_id,$message);
$stmt->execute();
$stmt->close();

header("Location: chat.php?user=".$receiver_id);

}
?>