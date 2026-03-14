<?php

include("includes/security.php");
include("config/database.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$name = sanitize($_POST['name']);
$email = sanitize($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = sanitize($_POST['role']);
$country = sanitize($_POST['country']);

$stmt = $conn->prepare(
"INSERT INTO users (name,email,password,role,country)
VALUES (?,?,?,?,?)"
);

$stmt->bind_param("sssss",$name,$email,$password,$role,$country);

$stmt->execute();

$stmt->close();

header("Location: login.php");
exit();

}
?>