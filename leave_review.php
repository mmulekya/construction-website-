<?php
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}

$constructor_id = $_GET['constructor_id'];
$project_id = $_GET['project_id'];

?>

<h2>Leave Review</h2>

<form action="save_review.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<input type="hidden" name="constructor_id" value="<?php echo $constructor_id; ?>">
<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Rating</label>

<select name="rating">
<option value="5">⭐⭐⭐⭐⭐ Excellent</option>
<option value="4">⭐⭐⭐⭐ Good</option>
<option value="3">⭐⭐⭐ Average</option>
<option value="2">⭐⭐ Poor</option>
<option value="1">⭐ Very Poor</option>
</select>

<label>Review</label>
<textarea name="review" placeholder="Share your experience"></textarea>

<button type="submit">Submit Review</button>

</form>

<?php include("includes/footer.php"); ?>