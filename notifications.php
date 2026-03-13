<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare(
"SELECT * FROM notifications WHERE user_id=? ORDER BY created_at DESC"
);

$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Notifications</h2>

<?php while($row=$result->fetch_assoc()){ ?>

<div class="card">

<p><?php echo htmlspecialchars($row['message']); ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>