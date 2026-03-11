<?php include("includes/header.php"); ?>

<h2>AI Construction Planner</h2>

<form action="planner_result.php" method="POST">

<label>Building Size (m²)</label>
<input type="number" name="size" required>

<label>Number of Floors</label>
<input type="number" name="floors" required>

<button type="submit">Generate Construction Plan</button>

</form>

<?php include("includes/footer.php"); ?>