<?php
include("includes/header.php");

$size = intval($_POST['size']);
$floors = intval($_POST['floors']);
$quality = htmlspecialchars($_POST['quality']);

$cost_per_m2 = 500;

if($quality=="medium"){
$cost_per_m2 = 800;
}

if($quality=="luxury"){
$cost_per_m2 = 1200;
}

$total_cost = $size * $floors * $cost_per_m2;
?>

<h2>Estimated Construction Cost</h2>

<p>House Size: <?php echo $size; ?> m²</p>
<p>Floors: <?php echo $floors; ?></p>
<p>Quality: <?php echo $quality; ?></p>

<h3>Total Estimated Cost: $<?php echo number_format($total_cost); ?></h3>

<a href="ai_cost_calculator.php">Calculate Again</a>

<?php include("includes/footer.php"); ?>