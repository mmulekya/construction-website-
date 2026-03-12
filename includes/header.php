<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>BuildSmart</title>

<link rel="stylesheet" href="assets/css/style.css">

<link rel="manifest" href="manifest.json">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<header>

<div class="logo">
<h2>🏗️ BuildSmart</h2>
</div>

<nav>

<a href="index.php">Home</a>

<a href="constructors.php">Constructors</a>

<a href="projects.php">Projects</a>

<a href="ai_estimator.php">AI Estimator</a>

<a href="ai_planner.php">AI Planner</a>

<a href="notifications.php">🔔 Notifications</a>

<a href="ai_chat.php">AI Assistant</a>

<?php if(isset($_SESSION['user_id'])) { ?>

<a href="dashboard.php">Dashboard</a>

<a href="logout.php">Logout</a>

<?php } else { ?>

<a href="login.php">Login</a>

<a href="signup.php">Signup</a>

<?php } ?>

</nav>

</header>

<div class="container">
