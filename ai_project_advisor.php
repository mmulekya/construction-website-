<?php
require_once "includes/security.php";
require_login();
include("includes/header.php");
?>

<h2>AI Smart Project Advisor</h2>

<form method="POST" action="ai_project_advisor.php">

<label>Project Type</label>
<select name="project_type" required>
<option value="house">House</option>
<option value="apartment">Apartment</option>
<option value="office">Office</option>
<option value="renovation">Renovation</option>
</select>

<br><br>

<label>Project Size (square meters)</label>
<input type="number" name="size" required>

<br><br>

<label>Location</label>
<input type="text" name="location" required>

<br><br>

<button type="submit">Get AI Advice</button>

</form>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

$project_type = sanitize($_POST['project_type']);
$size = intval($_POST['size']);
$location = sanitize($_POST['location']);

/* Basic AI logic */

$cost_per_m2 = 500;

if($project_type=="apartment"){
$cost_per_m2 = 650;
}

if($project_type=="office"){
$cost_per_m2 = 700;
}

if($project_type=="renovation"){
$cost_per_m2 = 300;
}

$estimated_cost = $size * $cost_per_m2;

$estimated_time = round($size / 50) . " months";

/* Constructor suggestion */

$constructor_type = "General Contractor";

if($project_type=="office"){
$constructor_type = "Commercial Construction Company";
}

if($project_type=="renovation"){
$constructor_type = "Renovation Specialist";
}

echo "<h3>AI Recommendation</h3>";
echo "<p><b>Estimated Cost:</b> $" . $estimated_cost . "</p>";
echo "<p><b>Estimated Duration:</b> " . $estimated_time . "</p>";
echo "<p><b>Recommended Constructor:</b> " . $constructor_type . "</p>";
}

include("includes/footer.php");
?>