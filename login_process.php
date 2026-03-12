<?php

session_start();

include("config/database.php");

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result()

$result = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

header("Location: dashboard.php");

}else{

echo "Invalid login";

}

?>