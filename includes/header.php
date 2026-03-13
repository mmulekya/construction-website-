<?php

if (session_status() === PHP_SESSION_NONE) {

session_set_cookie_params([
'lifetime' => 0,
'path' => '/',
'secure' => false,
'httponly' => true,
'samesite' => 'Strict'
]);

session_start();

}

?>

<!DOCTYPE html>
<html>
<head>

<title>BuildSmart</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar">

<a href="index.php">Home</a>
<a href="projects.php">Projects</a>
<a href="constructors.php">Constructors</a>
<a href="ai_chat.php">AI Assistant</a>
<a href="blog.php">Knowledge Hub</a>

<?php if(isset($_SESSION['user_id'])): ?>

<a href="dashboard.php">Dashboard</a>
<a href="logout.php">Logout</a>

<?php else: ?>

<a href="login.php">Login</a>
<a href="signup.php">Sign Up</a>

<?php endif; ?>

</nav>

<div class="container">
