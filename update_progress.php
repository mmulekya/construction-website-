<?php
include("includes/header.php");
include("config/database.php");

$project_id = $_GET['project_id'];
?>

<h2>Update Project Progress</h2>

<form action="save_progress.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Project Stage</label>
<select name="stage">
<option value="Foundation">Foundation</option>
<option value="Walls">Walls</option>
<option value="Roofing">Roofing</option>
<option value="Finishing">Finishing</option>
<option value="Completed">Completed</option>
</select>

<label>Progress (%)</label>
<input type="number" name="progress" max="100">

<label>Update Description</label>
<textarea name="update_text"></textarea>

<label>Upload Progress Photo</label>
<input type="file" name="photo">

<button type="submit">Update Progress</button>

</form>

<?php include("includes/footer.php"); ?>
