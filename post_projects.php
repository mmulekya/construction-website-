<?php
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}
?>

<h2>Post a Construction Project</h2>

<form action="save_project.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<label>Project Title</label>
<input type="text" name="title" required>

<label>Project Description</label>
<textarea name="description" required></textarea>

<label>Location</label>
<input type="text" name="location" placeholder="City or Country">

<label>Budget (USD)</label>
<input type="number" name="budget">

<button type="submit">Post Project</button>

</form>

<?php include("includes/footer.php"); ?>