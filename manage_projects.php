<?php

include("includes/header.php");
include("config/database.php");

$sql = "SELECT * FROM projects";

$result = mysqli_query($conn,$sql);

?>

<h2>Manage Projects</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<h3><?php echo $row['title']; ?></h3>

<p><?php echo $row['description']; ?></p>

<p><b>Budget:</b> $<?php echo $row['budget']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>
