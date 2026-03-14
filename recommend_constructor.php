<?php
include("includes/header.php");
include("config/database.php");
?>

<h2>Find the Best Constructor</h2>

<form action="ai_recommendation.php" method="POST">

<label>Project Type</label>

<select name="project_type">

<option value="house">Residential House</option>
<option value="apartment">Apartment</option>
<option value="commercial">Commercial Building</option>

</select>

<label>Project Location</label>
<input type="text" name="location" required>

<button type="submit">Find Constructor</button>

</form>

<?php include("includes/footer.php"); ?>