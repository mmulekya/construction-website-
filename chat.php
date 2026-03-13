<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$receiver_id = intval($_GET['user']);
$sender_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
SELECT messages.*, users.name 
FROM messages 
JOIN users ON messages.sender_id = users.id
WHERE (sender_id=? AND receiver_id=?) 
OR (sender_id=? AND receiver_id=?)
ORDER BY created_at ASC
");

$stmt->bind_param("iiii",$sender_id,$receiver_id,$receiver_id,$sender_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Chat</h2>

<div class="chat-box">

<?php while($msg = $result->fetch_assoc()){ ?>

<div class="message">

<strong><?php echo htmlspecialchars($msg['name']); ?>:</strong>

<p><?php echo htmlspecialchars($msg['message']); ?></p>

</div>

<?php } ?>

</div>

<form action="send_message.php" method="POST">

<input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">

<textarea name="message" required></textarea>

<button type="submit">Send</button>

</form>

<?php include("includes/footer.php"); ?>