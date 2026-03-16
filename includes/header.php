<?php
include_once "security.php";

/* Security headers */
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BuildSmart</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
<h1>BuildSmart</h1>

<nav>
<a href="index.php">Home</a>
<a href="projects.php">Projects</a>
<a href="constructors.php">Constructors</a>

<?php if(is_logged_in()) { ?>
<a href="dashboard.php">Dashboard</a>
<a href="profile.php">Profile</a>
<a href="logout.php">Logout</a>
<?php } else { ?>
<a href="login.php">Login</a>
<a href="signup.php">Signup</a>
<?php } ?>

</nav>
</header>

<div class="container">