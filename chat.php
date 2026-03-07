<?php
session_start();
include("config/database.php");

// Get project ID and validate
$project_id = $_GET['project_id'] ?? 0;

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<h2>Project Chat</h2>

<div id="chat-box" style="border:1px solid #ccc; padding:10px; height:300px; overflow:auto;">
<?php
$sql = "SELECT * FROM messages WHERE project_id='$project_id' ORDER BY created_at ASC";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
    $sender = $row['sender_id'] == $user_id ? "You" : "Other";
    echo "<p><b>$sender:</b> ".$row['message']."</p>";
}
?>
</div>

<form action="send_message.php" method="POST">
<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
<input type="text" name="message" placeholder="Type your message" required>
<button type="submit">Send</button>
</form>