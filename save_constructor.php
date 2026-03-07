<?php

session_start();
include("config/database.php");

$user_id = $_SESSION['user_id'];
$specialization = $_POST['specialization'];
$experience = $_POST['experience_years'];
$city = $_POST['city'];
$country = $_POST['country'];
$bio = $_POST['bio'];

$sql = "INSERT INTO constructors (user_id,specialization,experience_years,city,country,bio)
VALUES ('$user_id','$specialization','$experience','$city','$country','$bio')";

if(mysqli_query($conn,$sql)){
    echo "Profile created successfully!";
}else{
    echo "Error: " . mysqli_error($conn);
}

?>