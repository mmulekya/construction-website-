<?php
include("includes/header.php");
?>

<h2>AI Construction Cost Calculator</h2>

<form action="ai_estimator.php" method="POST">

<label>House Size (square meters)</label>
<input type="number" name="size" required>

<label>Number of Floors</label>
<input type="number" name="floors" required>

<label>Construction Quality</label>

<select name="quality">

<option value="standard">Standard</option>
<option value="medium">Medium</option>
<option value="luxury">Luxury</option>

</select>

<button type="submit">Estimate Cost</button>

</form>

<?php include("includes/footer.php"); ?>
