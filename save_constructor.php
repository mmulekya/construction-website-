<?php

session_start();

include("config/database.php");

$user_id = $_SESSION['user_id'];

$specialization = $_POST['specialization'];
$experience = $_POST['experience'];
$city = $_POST['city'];
$bio = $_POST['bio'];

$sql = "INSERT INTO constructors (user_id,specialization,experience,city,bio)
VALUES ('$user_id','$specialization','$experience','$city','$bio')";

if(mysqli_query($conn,$sql)){

header("Location: constructors.php");

}else{

echo "Error saving profile";

}

?>