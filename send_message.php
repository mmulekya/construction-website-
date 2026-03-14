<?php

session_start();

include("config/database.php");
require_once("includes/security.php");
require_once("includes/message_rate_limit.php");
require_once("includes/auth.php");

require_login();

if($_SERVER["REQUEST_METHOD"] === "POST"){

/* CSRF token verification */
if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
die("Invalid request.");
}

$sender_id = $_SESSION['user_id'];

$receiver_id = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;

$message = isset($_POST['message']) ? sanitize($_POST['message']) : "";

/* check empty message */
if(empty($message)){
die("Message cannot be empty.");
}

/* rate limit protection */
if(!check_message_rate_limit($sender_id)){
die("You are sending messages too fast. Please wait.");
}

/* prepared statement */
$stmt = $conn->prepare(
"INSERT INTO messages (sender_id, receiver_id, message)
VALUES (?, ?, ?)"
);

$stmt->bind_param("iis", $sender_id, $receiver_id, $message);

if($stmt->execute()){

$stmt->close();

header("Location: chat.php?user=".$receiver_id);
exit();

}else{

die("Failed to send message.");

}

}
?>