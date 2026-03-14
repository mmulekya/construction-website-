<?php

include("includes/header.php");
include("config/database.php");
require_once "includes/security.php";
require_login();

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

<h3>Portfolio</h3>

<?php

$sql = "SELECT * FROM portfolios WHERE user_id='$id'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

<h4><?php echo $row['title']; ?></h4>

<img src="uploads/<?php echo $row['image']; ?>" width="250">

<p><?php echo $row['description']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>