<?php

session_start();
include("config/database.php");

$user_id = $_SESSION['user_id'];

$city = $_POST['city'];
$specialization = $_POST['specialization'];
$experience = $_POST['experience'];
$bio = $_POST['bio'];

$photo = $_FILES['photo']['name'];

if($photo != ""){

move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);

$sql = "UPDATE users SET
city='$city',
specialization='$specialization',
experience='$experience',
bio='$bio',
photo='$photo'
WHERE id='$user_id'";

}else{

$sql = "UPDATE users SET
city='$city',
specialization='$specialization',
experience='$experience',
bio='$bio'
WHERE id='$user_id'";

}

mysqli_query($conn,$sql);

header("Location: profile.php");

?>