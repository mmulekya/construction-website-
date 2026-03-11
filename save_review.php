<?php

session_start();

include("config/database.php");

$client_id = $_SESSION['user_id'];

$constructor_id = $_POST['constructor_id'];
$project_id = $_POST['project_id'];
$rating = $_POST['rating'];
$review = $_POST['review'];

$sql = "INSERT INTO reviews (constructor_id,client_id,project_id,rating,review)
VALUES ('$constructor_id','$client_id','$project_id','$rating','$review')";

if(mysqli_query($conn,$sql)){

header("Location: constructors.php");

}else{

echo "Review failed";

}

?>