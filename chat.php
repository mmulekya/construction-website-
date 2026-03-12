<?php
include("includes/header.php");
include("config/database.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}

$project_id = $_GET['project_id'];
$receiver_id = $_GET['user'];

?>

<h2>Project Chat</h2>

<div class="chat-box">

<?php

$sql = "SELECT messages.*, users.name
FROM messages
JOIN users ON messages.sender_id = users.id
WHERE project_id='$project_id'
ORDER BY created_at ASC";

$result = mysqli_query($conn,$sql);

while($msg = mysqli_fetch_assoc($result)){

echo "<p><b>".$msg['name']."</b>: ".$msg['message']."</p>";

}

?>

</div>

<form action="send_message.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
<input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">

<input type="text" name="message" placeholder="Type your message..." required>

<button type="submit">Send</button>

</form>

<?php include("includes/footer.php"); ?>