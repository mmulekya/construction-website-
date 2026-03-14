<?php
include("includes/header.php");
include("includes/auth.php");

$project_id = intval($_GET['project_id']);
?>

<h2>Update Project Progress</h2>

<form action="save_progress.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Construction Stage</label>
<input type="text" name="stage" required>

<label>Progress Percentage</label>
<input type="number" name="progress" min="0" max="100" required>

<label>Update Description</label>
<textarea name="description" required></textarea>

<label>Upload Site Photo</label>
<input type="file" name="photo" accept="image/*">

<button type="submit">Save Update</button>

</form>

<?php include("includes/footer.php"); ?>