<?php

include("includes/header.php");
include("config/database.php");

$sql = "SELECT * FROM payments";

$result = mysqli_query($conn,$sql);

?>

<h2>Manage Payments</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<p><b>Project:</b> <?php echo $row['project_id']; ?></p>

<p><b>Amount:</b> $<?php echo $row['amount']; ?></p>

<p><b>Status:</b> <?php echo $row['status']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>
