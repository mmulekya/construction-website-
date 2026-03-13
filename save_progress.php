<?php

session_start();
include("config/database.php");

$project_id = $_POST['project_id'];
$stage = $_POST['stage'];
$progress = $_POST['progress'];
$update_text = $_POST['update_text'];

$photo = $_FILES['photo']['name'];

if($photo != ""){
move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);
}

$sql = "INSERT INTO project_progress
(project_id,stage,progress,update_text,photo)
VALUES
('$project_id','$stage','$progress','$update_text','$photo')";

mysqli_query($conn,$sql);

header("Location: project_details.php?id=".$project_id);

?>