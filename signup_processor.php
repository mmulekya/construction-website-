<?php

include("config/database.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$country = $_POST['country'];

$sql = "INSERT INTO users (name,email,password,role,country)
VALUES ('$name','$email','$password','$role','$country')";

if(mysqli_query($conn,$sql)){
    echo "Account created successfully!";
}else{
    echo "Error: " . mysqli_error($conn);
}

?>