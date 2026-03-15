<?php
require_once "includes/security.php";
require_login();
include("config/database.php");

$receiver_id = intval($_GET['receiver_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
SELECT sender_id,message,created_at 
FROM messages 
WHERE (sender_id=? AND receiver_id=?)
OR (sender_id=? AND receiver_id=?)
ORDER BY created_at ASC
");

$stmt->bind_param("iiii",$user_id,$receiver_id,$receiver_id,$user_id);
$stmt->execute();
$result = $stmt->get_result();

while($row=$result->fetch_assoc()){

$sender = $row['sender_id']==$user_id ? "You" : "Them";

echo "<p><b>".$sender.":</b> ".e($row['message'])."</p>";

}
?>