<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$result = $conn->query("SELECT * FROM payments ORDER BY id DESC");
?>

<h2>All Platform Payments</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<p>User ID: <?php echo htmlspecialchars($row['user_id']); ?></p>

<p>Project ID: <?php echo htmlspecialchars($row['project_id']); ?></p>

<p>Amount: $<?php echo htmlspecialchars($row['amount']); ?></p>

<p>Method: <?php echo htmlspecialchars($row['method']); ?></p>

<p>Status: <?php echo htmlspecialchars($row['status']); ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>