<?php

include("includes/header.php");

$size = $_POST['size'];
$floors = $_POST['floors'];

$total_area = $size * $floors;

if($total_area < 150){
$duration = "3 - 4 months";
}

elseif($total_area < 400){
$duration = "5 - 7 months";
}

else{
$duration = "8 - 12 months";
}

?>

<h2>AI Construction Plan</h2>

<p><b>Building Size:</b> <?php echo $size; ?> m²</p>

<p><b>Floors:</b> <?php echo $floors; ?></p>

<p><b>Estimated Duration:</b> <?php echo $duration; ?></p>

<h3>Construction Stages</h3>

<ul>

<li>Site preparation (1 week)</li>

<li>Foundation construction (2 - 3 weeks)</li>

<li>Wall and structure building (4 - 8 weeks)</li>

<li>Roof installation (2 weeks)</li>

<li>Electrical and plumbing installation (2 - 4 weeks)</li>

<li>Interior finishing (4 weeks)</li>

<li>Final inspection and handover</li>

</ul>

<a href="post_project.php">Start Project</a>

<?php include("includes/footer.php"); ?>