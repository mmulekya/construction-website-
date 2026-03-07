<?php
session_start();
include("config/database.php");

$project_id = $_GET['project_id'];
?>

<h2>Update Project Progress</h2>

<form action="save_update.php" method="POST">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<textarea name="update_text" placeholder="Write project progress update" required></textarea>

<button type="submit">Post Update</button>

</form>