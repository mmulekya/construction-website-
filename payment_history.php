<?php
include("includes/header.php");
include("config/database.php");

$client_id = $_SESSION['user_id'];

$sql = "SELECT payments.*, users.name AS constructor_name
FROM payments
JOIN users ON payments.constructor_id = users.id
WHERE client_id='$client_id'";

$result = mysqli_query($conn,$sql);
?>

<h2>Payment History</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">
<p><b>Project ID:</b> <?php echo $row['project_id']; ?></p>
<p><b>Constructor:</b> <?php echo $row['constructor_name']; ?></p>
<p><b>Amount:</b> $<?php echo $row['amount']; ?></p>
<p><b>Method:</b> <?php echo $row['method']; ?></p>
<p><b>Status:</b> <?php echo $row['status']; ?></p>
</div>

<?php } ?>

<?php include("includes/footer.php"); ?>