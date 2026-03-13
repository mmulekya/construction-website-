<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$project_id = intval($_GET['id']);

$stmt = $conn->prepare(
"SELECT bids.*, users.name
FROM bids
JOIN users ON bids.user_id = users.id
WHERE project_id=?"
);

$stmt->bind_param("i",$project_id);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
?>

<div class="card">

<h3><?php echo htmlspecialchars($row['name']); ?></h3>

<p>Bid: $<?php echo htmlspecialchars($row['amount']); ?></p>

<p><?php echo htmlspecialchars($row['proposal']); ?></p>

<a href="hire_constructor.php?bid_id=<?php echo $row['id']; ?>">Hire</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>
