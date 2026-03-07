<?php
session_start();
include("config/database.php");

$sender_id = $_SESSION['user_id'];
$project_id = $_POST['project_id'];
$message = $_POST['message'];

// Determine receiver_id
// For simplicity, we assume two users: client and constructor
// You can improve this later with dynamic assignment
$project = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM projects WHERE id='$project_id'"));
$receiver_id = ($project['client_id'] == $sender_id) 
               ? mysqli_fetch_assoc(mysqli_query($conn,"SELECT user_id FROM constructors WHERE user_id!='$sender_id'"))['user_id']
               : $project['client_id'];

$sql = "INSERT INTO messages (project_id,sender_id,receiver_id,message)
VALUES ('$project_id','$sender_id','$receiver_id','$message')";

if(mysqli_query($conn,$sql)){
    header("Location: chat.php?project_id=$project_id");
}else{
    echo "Error: ".mysqli_error($conn);
}
