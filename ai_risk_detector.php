<?php
require_once "includes/security.php";
require_login();
include("includes/header.php");
?>

<h2>AI Project Risk Detector</h2>

<form method="POST">

<label>Describe Your Construction Project</label><br>
<textarea name="description" rows="6" cols="50" required></textarea>

<br><br>

<button type="submit">Analyze Risk</button>

</form>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

$description = strtolower(sanitize($_POST['description']));

$risk_level = "Low";
$warnings = [];

/* Risk detection rules */

if(strpos($description,"skyscraper")!==false){
$risk_level = "High";
$warnings[] = "Very complex project structure.";
}

if(strpos($description,"large")!==false){
$risk_level = "Medium";
$warnings[] = "Large project may increase construction time.";
}

if(strpos($description,"basement")!==false){
$warnings[] = "Basement construction may increase cost.";
}

if(strpos($description,"city center")!==false){
$warnings[] = "Urban construction may face permit delays.";
}

if(strpos($description,"cheap")!==false){
$warnings[] = "Low budget may reduce material quality.";
}

echo "<h3>AI Risk Analysis</h3>";

echo "<p><b>Risk Level:</b> ".$risk_level."</p>";

if(!empty($warnings)){
echo "<ul>";
foreach($warnings as $w){
echo "<li>".$w."</li>";
}
echo "</ul>";
}else{
echo "<p>No major risks detected.</p>";
}

}

include("includes/footer.php");
?>