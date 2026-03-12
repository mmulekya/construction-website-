<?php

include("includes/header.php");
include("config/database.php");

$sql = "SELECT * FROM users";

$result = mysqli_query($conn,$sql);

?>

<h2>Manage Users</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<p><b>Name:</b> <?php echo $row['name']; ?></p>

<p><b>Email:</b> <?php echo $row['email']; ?></p>

<p><b>Role:</b> <?php echo $row['role']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>


