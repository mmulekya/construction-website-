<?php
require_once "includes/security.php";
require_login();
include("includes/header.php");
?>

<h2>AI Budget Predictor</h2>

<form method="POST">

<label>Describe Your Construction Project</label><br>
<textarea name="description" rows="6" cols="50" required></textarea>

<br><br>

<button type="submit">Predict Budget</button>

</form>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

$description = strtolower(sanitize($_POST['description']));

$estimated_budget = 0;

/* Simple AI keyword logic */

if(strpos($description,"house")!==false){
$estimated_budget += 80000;
}

if(strpos($description,"apartment")!==false){
$estimated_budget += 120000;
}

if(strpos($description,"office")!==false){
$estimated_budget += 150000;
}

if(strpos($description,"renovation")!==false){
$estimated_budget += 30000;
}

if(strpos($description,"garage")!==false){
$estimated_budget += 15000;
}

/* default if nothing matched */

if($estimated_budget==0){
$estimated_budget = 50000;
}

echo "<h3>AI Estimated Budget</h3>";
echo "<p>Estimated construction budget: <b>$".$estimated_budget."</b></p>";
}

include("includes/footer.php");
?>