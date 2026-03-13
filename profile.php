<?php

include("includes/header.php");
include("config/database.php");

$id = $_GET['id'] ?? $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);

?>

<h2><?php echo $user['name']; ?></h2>

<img src="uploads/<?php echo $user['photo']; ?>" width="150">

<p><b>City:</b> <?php echo $user['city']; ?></p>

<p><b>Specialization:</b> <?php echo $user['specialization']; ?></p>

<p><b>Experience:</b> <?php echo $user['experience']; ?> years</p>

<p><b>About:</b> <?php echo $user['bio']; ?></p>

<?php include("includes/footer.php"); ?>