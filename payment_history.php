<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare(
"SELECT * FROM payments WHERE user_id=? ORDER BY id DESC"
);

$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Payment History</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<p><b>Project ID:</b> <?php echo htmlspecialchars($row['project_id']); ?></p>

<p><b>Amount:</b> $<?php echo htmlspecialchars($row['amount']); ?></p>

<p><b>Method:</b> <?php echo htmlspecialchars($row['method']); ?></p>

<p><b>Status:</b> <?php echo htmlspecialchars($row['status']); ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>