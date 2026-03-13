<?php
include("includes/header.php");
include("includes/auth.php");

$constructor_id = intval($_GET['constructor_id']);
?>

<h2>Leave Review</h2>

<form action="save_review.php" method="POST">

<input type="hidden" name="constructor_id" value="<?php echo $constructor_id; ?>">

<label>Rating</label>

<select name="rating">

<option value="5">⭐⭐⭐⭐⭐ Excellent</option>
<option value="4">⭐⭐⭐⭐ Very Good</option>
<option value="3">⭐⭐⭐ Good</option>
<option value="2">⭐⭐ Fair</option>
<option value="1">⭐ Poor</option>

</select>

<label>Review</label>

<textarea name="review" required></textarea>

<button type="submit">Submit Review</button>

</form>

<?php include("includes/footer.php"); ?>