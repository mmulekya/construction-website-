<?php

include("includes/header.php");

$size = $_POST['size'];
$floors = $_POST['floors'];
$quality = $_POST['quality'];

if($quality == "basic"){
$cost_per_m2 = 300;
}

if($quality == "standard"){
$cost_per_m2 = 500;
}

if($quality == "luxury"){
$cost_per_m2 = 900;
}

$total_cost = $size * $floors * $cost_per_m2;

?>

<h2>Estimated Construction Cost</h2>

<p><b>Building Size:</b> <?php echo $size; ?> m²</p>

<p><b>Floors:</b> <?php echo $floors; ?></p>

<p><b>Quality:</b> <?php echo $quality; ?></p>

<h3>Estimated Cost: $<?php echo number_format($total_cost); ?></h3>

<p>This is an approximate estimate. Actual cost may vary depending on materials, labor, and location.</p>

<a href="post_project.php">Post this Project</a>

<?php include("includes/footer.php"); ?>