<h2>Leave a Review</h2>

<form action="save_review.php" method="POST">

<input type="hidden" name="constructor_id" value="<?php echo $constructor_id; ?>">
<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Rating</label>
<select name="rating">
<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>
</select>

<label>Review</label>
<textarea name="review"></textarea>

<button type="submit">Submit Review</button>

</form>