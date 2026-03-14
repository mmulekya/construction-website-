<?php
include("includes/header.php");
include("config/database.php");

$user_id = intval($_GET['user']);

$stmt = $conn->prepare(
"SELECT * FROM portfolios WHERE user_id=? ORDER BY id DESC"
);

$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Constructor Portfolio</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<h3><?php echo htmlspecialchars($row['title']); ?></h3>

<img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="300">

<p><?php echo htmlspecialchars($row['description']); ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>