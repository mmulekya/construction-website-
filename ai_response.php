<?php
include("config/database.php");
include("includes/security.php");

check_login();

// Fetch latest AI responses for this user
$stmt = $conn->prepare("SELECT * FROM ai_responses WHERE user_id=? ORDER BY created_at DESC LIMIT 20");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$responses = [];
while($row = $result->fetch_assoc()) $responses[] = $row;
$stmt->close();
?>

<?php include("includes/header.php"); ?>
<h2>AI Responses</h2>
<?php if(empty($responses)) echo "<p>No AI responses yet.</p>"; ?>
<?php foreach($responses as $r){ ?>
<p><b><?php echo e($r['title']); ?>:</b> <?php echo e($r['response']); ?></p>
<?php } ?>
<?php include("includes/footer.php"); ?>