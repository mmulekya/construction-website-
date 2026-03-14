<?php
include("includes/security.php");
require_login();
include("config/database.php");

$project_id=intval($_GET['project_id'] ?? 0);
$other_user_id=intval($_GET['user_id'] ?? 0);

// Fetch messages
$stmt=$conn->prepare("SELECT m.*, u.name AS sender_name FROM messages m JOIN users u ON m.sender_id=u.id WHERE m.project_id=? AND (m.sender_id=? OR m.receiver_id=?) ORDER BY m.created_at ASC");
$user_id=$_SESSION['user_id'];
$stmt->bind_param("iii",$project_id,$user_id,$user_id);
$stmt->execute();
$result=$stmt->get_result();
?>

<div id="chatBox">
<?php while($msg=$result->fetch_assoc()){ ?>
<p><b><?php echo htmlspecialchars($msg['sender_name']); ?>:</b> <?php echo htmlspecialchars($msg['message']); ?></p>
<?php } ?>
</div>

<form id="chatForm">
<input type="text" id="msgInput" required>
<button>Send</button>
</form>

<script>
const chatForm=document.getElementById('chatForm');
const chatBox=document.getElementById('chatBox');

chatForm.addEventListener('submit', async e=>{
    e.preventDefault();
    const message=document.getElementById('msgInput').value;
    const response=await fetch('chat_ajax.php',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({project_id:<?php echo $project_id; ?>,user_id:<?php echo $other_user_id; ?>,message:message})
    });
    const data=await response.json();
    if(data.status==='success'){
        chatBox.innerHTML+=`<p><b>You:</b> ${message}</p>`;
        document.getElementById('msgInput').value='';
    }
});
</script>