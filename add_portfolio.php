<?php
include("includes/header.php");
include("config/database.php");

$user_id = $_SESSION['user_id'];
?>

<h2>Add Portfolio Project</h2>

<form action="save_portfolio.php" method="POST" enctype="multipart/form-data">

<label>Project Title</label>
<input type="text" name="title" required>

<label>Description</label>
<textarea name="description" required></textarea>

<label>Project Image</label>
<input type="file" name="image" required>

<button type="submit">Upload Project</button>

</form>

<?php include("includes/footer.php"); ?>

