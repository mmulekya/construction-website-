<?php include("includes/header.php"); ?>

<h2>AI Construction Cost Estimator</h2>

<form action="estimate_result.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<label>Building Size (square meters)</label>
<input type="number" name="size" required>

<label>Number of Floors</label>
<input type="number" name="floors" required>

<label>Construction Quality</label>
<select name="quality">
<option value="basic">Basic</option>
<option value="standard">Standard</option>
<option value="luxury">Luxury</option>
</select>

<button type="submit">Estimate Cost</button>

</form>

<?php include("includes/footer.php"); ?>