<?php
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}

$project_id = $_GET['project_id'];
?>

<h2>Post Project Update</h2>

<form action="save_update.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Update Details</label>
<textarea name="update_text" placeholder="Describe the progress..." required></textarea>

<button type="submit">Post Update</button>

</form>

<?php include("includes/footer.php"); ?>