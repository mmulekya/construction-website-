<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$error = "";

// Handle new message
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $receiver_id = intval($_POST['receiver_id']);
    $message_text = clean_input($_POST['message']);

    if(empty($message_text)){
        $error = "Message cannot be empty.";
    }

    // Optional: simple spam check, e.g., message length or repeated messages
    if(strlen($message_text) > 2000){
        $error = "Message too long.";
    }

    if(empty($error)){
        $stmt = $conn->prepare("INSERT INTO messages (sender_id,receiver_id,message,created_at) VALUES (?,?,?,NOW())");
        $stmt->bind_param("iis", $_SESSION['user_id'], $receiver_id, $message_text);
        if(!$stmt->execute()){
            $error = "Failed to send message.";
        }
        $stmt->close();
    }
}

// Fetch recent messages between user and selected receiver
$receiver_id = isset($_GET['user']) ? intval($_GET['user']) : 0;

$messages = [];
if($receiver_id > 0){
    $stmt = $conn->prepare("
        SELECT m.*, u.name as sender_name 
        FROM messages m 
        JOIN users u ON m.sender_id=u.id
        WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)
        ORDER BY created_at ASC
    ");
    $stmt->bind_param("iiii", $_SESSION['user_id'],$receiver_id,$receiver_id,$_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $messages[] = $row;
    }
    $stmt->close();
}

?>

<?php include("includes/header.php"); ?>

<h2>Chat</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<?php if($receiver_id > 0){ ?>
<div class="chat-box">
    <?php foreach($messages as $msg){ ?>
        <p><b><?php echo htmlspecialchars($msg['sender_name']); ?>:</b> <?php echo htmlspecialchars($msg['message']); ?></p>
    <?php } ?>
</div>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
    <textarea name="message" required placeholder="Type your message here..."></textarea><br><br>
    <button type="submit">Send</button>
</form>

<?php } else { ?>
<p>Select a user to start chatting.</p>
<?php } ?>

<?php include("includes/footer.php"); ?>