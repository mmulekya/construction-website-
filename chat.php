<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

// Must be logged in
if(!isset($_SESSION['user_id'])){
    die("Please log in to chat.");
}

$project_id = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;
$other_user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Send a message
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $message = sanitize($_POST['message']);
    $sender = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO messages (project_id, sender_id, receiver_id, message) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis", $project_id, $sender, $other_user_id, $message);
    $stmt->execute();
    $stmt->close();
}

// Fetch messages
$stmt = $conn->prepare("
    SELECT m.*, u.name AS sender_name 
    FROM messages m
    JOIN users u ON m.sender_id = u.id
    WHERE m.project_id=? AND (m.sender_id=? OR m.receiver_id=?)
    ORDER BY m.created_at ASC
");
$user_id = $_SESSION['user_id'];
$stmt->bind_param("iii", $project_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Project Chat</h2>

<div class="chat-box">
<?php while($msg = $result->fetch_assoc()){ ?>
    <p><b><?php echo htmlspecialchars($msg['sender_name']); ?>:</b> <?php echo htmlspecialchars($msg['message']); ?></p>
<?php } ?>
</div>

<form method="POST">
    <input type="text" name="message" required placeholder="Type your message...">
    <button type="submit">Send</button>
</form>

<?php
$stmt->close();
include("includes/footer.php");
?>