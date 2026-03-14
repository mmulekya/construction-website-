<?php
include("includes/header.php");
?>

<h2>BuildSmart AI Assistant</h2>

<p>Ask anything about building, materials, or construction planning.</p>

<form action="ai_response.php" method="POST">

<input type="text" name="question" placeholder="Example: How much does it cost to build a 3 bedroom house?" required>

<button type="submit">Ask AI</button>

</form>

<?php include("includes/footer.php"); ?>
