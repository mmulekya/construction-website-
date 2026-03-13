<?php

$size = $_POST['size'];
$floors = $_POST['floors'];
$type = $_POST['type'];

$base_cost_per_m2 = 300;

if($type == "modern"){
$base_cost_per_m2 = 450;
}

if($type == "luxury"){
$base_cost_per_m2 = 700;
}

$total_cost = $size * $base_cost_per_m2 * $floors;

echo "<h2>Estimated Construction Cost</h2>";

echo "Estimated Cost: $" . number_format($total_cost);

echo "<br><br>";

echo "<a href='ai_cost_calculator.php'>Calculate Again</a>";

?>