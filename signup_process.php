<?php

require "config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];
$role = $_POST['role'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
die("Invalid email");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");

$stmt->bind_param("ssss",$name,$email,$hashed_password,$role);

$stmt->execute();

$stmt->close();

header("Location: login.php");

}

?>
