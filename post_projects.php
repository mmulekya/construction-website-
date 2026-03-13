<?php
include("includes/header.php");
include("includes/auth.php");
?>

<h2>Post a New Construction Project</h2>

<form action="save_project.php" method="POST">

<label>Project Title</label>
<input type="text" name="title" required maxlength="150">

<label>Description</label>
<textarea name="description" required></textarea>

<label>Location</label>
<input type="text" name="location" required>

<label>Budget (USD)</label>
<input type="number" name="budget" required>

<button type="submit">Post Project</button>

</form>

<?php include("includes/footer.php"); ?>