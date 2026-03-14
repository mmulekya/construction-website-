<?php
include("includes/header.php");

$question = htmlspecialchars(trim($_POST['question']));

$answer = "Sorry, I cannot answer that yet.";

if(stripos($question,"foundation")!==false){
$answer = "A strong foundation is critical. Common types include strip foundations and raft foundations depending on soil conditions.";
}

elseif(stripos($question,"cement")!==false){
$answer = "Cement is used for concrete. The typical mix ratio for structural concrete is 1:2:4 (cement:sand:aggregate).";
}

elseif(stripos($question,"cost")!==false){
$answer = "Construction costs depend on location, materials, and design. Use our AI Cost Calculator for an estimate.";
}

?>

<h2>Your Question</h2>
<p><?php echo $question; ?></p>

<h2>AI Answer</h2>
<p><?php echo $answer; ?></p>

<a href="ai_chat.php">Ask Another Question</a>

<?php include("includes/footer.php"); ?>