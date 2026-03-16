<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$chat_history = [];

// Fetch previous messages with AI from DB if exists
$stmt = $conn->prepare("SELECT * FROM ai_chat WHERE user_id=? ORDER BY created_at ASC");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $chat_history[] = $row;
}
$stmt->close();

// Handle new message
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $user_message = clean_input($_POST['message']);
    if(!empty($user_message)){
        // Placeholder AI response
        $ai_response = "AI Suggestion: Based on your input, consider phased planning.";

        // Save user message
        $stmt = $conn->prepare("INSERT INTO ai_chat (user_id,message,role,created_at) VALUES (?,?,?,NOW())");
        $role = "user";
        $stmt->bind_param("iss", $_SESSION['user_id'],$user_message,$role);
        $stmt->execute();
        $stmt->close();

        // Save AI response
        $stmt = $conn->prepare("INSERT INTO ai_chat (user_id,message,role,created_at) VALUES (?,?,?,NOW())");
        $role = "ai";
        $stmt->bind_param("iss", $_SESSION['user_id'],$ai_response,$role);
        $stmt->execute();
        $stmt->close();

        $chat_history[] = ["role"=>"user","message"=>$user_message];
        $chat_history[] = ["role"=>"ai","message"=>$ai_response];
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>AI Chat Assistant</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<div class="chat-box" style="border:1px solid #ccc; padding:10px; max-height:400px; overflow-y:auto;">
<?php foreach($chat_history as $msg){ ?>
<p><b><?php echo e(ucfirst($msg['role'])); ?>:</b> <?php echo e($msg['message']); ?></p>
<?php } ?>
</div>

<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<textarea name="message" required placeholder="Type your question here..." rows="3" style="width:100%;"></textarea><br><br>
<button type="submit">Send</button>
</form>

<?php include("includes/footer.php"); ?>