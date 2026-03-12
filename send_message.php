<?php

session_start();

if($_POST['token'] !== $_SESSION['token']){
    die("Invalid request");
}


include("config/database.php");

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$project_id = $_POST['project_id'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (project_id,sender_id,receiver_id,message)
VALUES ('$project_id','$sender_id','$receiver_id','$message')";

if(mysqli_query($conn,$sql)){

header("Location: chat.php?project_id=".$project_id."&user=".$receiver_id);

}else{

echo "Message failed";
echo "Message sent successfully";

}

?>