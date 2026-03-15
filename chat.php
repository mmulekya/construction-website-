<?php
require_once "includes/security.php";
require_login();
include("includes/header.php");

$receiver_id = intval($_GET['user_id']);
?>

<h2>Chat</h2>

<div id="chat-box" style="border:1px solid #ccc;height:300px;overflow-y:scroll;padding:10px;"></div>

<form id="chat-form">

<input type="hidden" id="receiver_id" value="<?php echo $receiver_id; ?>">

<input type="text" id="message" placeholder="Type message..." required>

<button type="submit">Send</button>

</form>

<script>

function loadMessages(){

let receiver=document.getElementById("receiver_id").value;

fetch("fetch_messages.php?receiver_id="+receiver)
.then(res=>res.text())
.then(data=>{
document.getElementById("chat-box").innerHTML=data;
});

}

setInterval(loadMessages,2000); // refresh every 2 seconds

document.getElementById("chat-form").addEventListener("submit",function(e){

e.preventDefault();

let msg=document.getElementById("message").value;
let receiver=document.getElementById("receiver_id").value;

fetch("send_message.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"message="+encodeURIComponent(msg)+"&receiver_id="+receiver

}).then(()=>{
document.getElementById("message").value="";
loadMessages();
});

});

loadMessages();

</script>

<?php include("includes/footer.php"); ?>