<h2>AI Construction Project Planner</h2>

<form action="planner_result.php" method="POST">

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

<button type="submit">Generate Plan</button>

</form>