<?php include("includes/header.php"); ?>

<h2>AI Construction Assistant</h2>

<div id="chat-box" style="border:1px solid #ccc; padding:15px; height:300px; overflow:auto;">
<p><b>AI:</b> Hello! Ask me anything about construction.</p>
</div>

<input type="text" id="question" placeholder="Ask a construction question..." style="width:80%;">
<button onclick="askAI()">Send</button>

<script>

function askAI(){

let question = document.getElementById("question").value;

fetch("ai_response.php",{

method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:"question="+question

})

.then(response=>response.text())

.then(data=>{

let chatBox = document.getElementById("chat-box");

chatBox.innerHTML += "<p><b>You:</b> "+question+"</p>";
chatBox.innerHTML += "<p><b>AI:</b> "+data+"</p>";

document.getElementById("question").value="";

});

}

</script>

<?php include("includes/footer.php"); ?>