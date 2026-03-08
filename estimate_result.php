<?php

$type = $_POST['type'];
$size = $_POST['size'];
$floors = $_POST['floors'];
$quality = $_POST['quality'];

$cost_per_m2 = 500;

if($quality == "Standard"){
$cost_per_m2 = 700;
}

if($quality == "Luxury"){
$cost_per_m2 = 1000;
}

$total_cost = $size * $floors * $cost_per_m2;

echo "<h2>Estimated Construction Cost</h2>";
echo "<h3>$".$total_cost."</h3>";

?>