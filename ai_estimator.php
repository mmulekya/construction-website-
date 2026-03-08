<h2>AI Construction Cost Estimator</h2>

<form action="estimate_result.php" method="POST">

<label>Building Type</label>
<select name="type">
<option>House</option>
<option>Apartment</option>
<option>Office</option>
</select>

<label>Size (m²)</label>
<input type="number" name="size" required>

<label>Floors</label>
<input type="number" name="floors" required>

<label>Material Quality</label>
<select name="quality">
<option>Basic</option>
<option>Standard</option>
<option>Luxury</option>
</select>

<button type="submit">Estimate Cost</button>

</form>