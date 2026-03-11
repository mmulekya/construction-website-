<?php

session_start();

include("config/database.php");

$constructor_id = $_SESSION['user_id'];

$project_id = $_POST['project_id'];
$update_text = $_POST['update_text'];

$sql = "INSERT INTO project_updates (project_id,constructor_id,update_text)
VALUES ('$project_id','$constructor_id','$update_text')";

if(mysqli_query($conn,$sql)){

header("Location: project_details.php?id=".$project_id);

}else{

echo "Update failed";

}

?>