<?php

include("includes/security.php");
include("config/database.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$email = sanitize($_POST['email']);
$password = $_POST['password'];

/* LOGIN RATE LIMIT */

if(!isset($_SESSION['login_attempts'])){
$_SESSION['login_attempts'] = 0;
}

if($_SESSION['login_attempts'] >= 5){
die("Too many login attempts. Please wait and try again.");
}

/* CHECK USER */

$stmt = $conn->prepare("SELECT id,password,role FROM users WHERE email=?");

$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 1){

$user = $result->fetch_assoc();

if(password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

$_SESSION['login_attempts'] = 0;

header("Location: index.php");
exit();

}else{

$_SESSION['login_attempts']++;
echo "Incorrect password.";

}

}else{

$_SESSION['login_attempts']++;
echo "User not found.";

}

$stmt->close();

}
?> 