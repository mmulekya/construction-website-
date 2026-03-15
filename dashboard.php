<?php
require_once "includes/security.php";
require_login();
include("config/database.php");
include("includes/header.php");

$user_id = $_SESSION['user_id'];

/* Get user projects */
$stmt = $conn->prepare("SELECT title,budget,status FROM projects WHERE user_id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<h2>Dashboard</h2>

<h3>Welcome to BuildSmart</h3>

<p>Your AI-powered construction platform.</p>

<hr>

<h3>Your Projects</h3>

<?php

if($result->num_rows>0){

while($row=$result->fetch_assoc()){

echo "<div class='card'>";

echo "<h4>".e($row['title'])."</h4>";

echo "<p>Budget: $".e($row['budget'])."</p>";

echo "<p>Status: ".e($row['status'])."</p>";

echo "</div>";

}

}else{

echo "<p>No projects yet.</p>";

}

?>

<hr>

<h3>AI Quick Tools</h3>

<ul>
<li><a href="ai_estimator.php">AI Cost Estimator</a></li>
<li><a href="ai_planner.php">AI Project Planner</a></li>
<li><a href="ai_cost_calculator.php">AI Cost Calculator</a></li>
<li><a href="ai_project_advisor.php">AI Project Advisor</a></li>
<li><a href="ai_budget_predictor.php">AI Budget Predictor</a></li>
<li><a href="ai_risk_detector.php">AI Risk Detector</a></li>
</ul>

<hr>

<h3>Recommended Constructors</h3>

<?php

$cons = $conn->query("SELECT name,location FROM constructors LIMIT 3");

while($c=$cons->fetch_assoc()){

echo "<div class='card'>";

echo "<p><b>".e($c['name'])."</b></p>";

echo "<p>".e($c['location'])."</p>";

echo "</div>";

}

?>

<?php include("includes/footer.php"); ?>