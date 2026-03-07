<?php

session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

?>
<h1>Welcome <?php echo $_SESSION['name']; ?></h1>

<p>You are logged in to BuildSmart.</p>

<a href="logout.php">Logout</a>