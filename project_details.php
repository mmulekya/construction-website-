<?php

include("includes/header.php");
include("config/database.php");

$id = $_GET['id'];

$sql = "SELECT * FROM projects WHERE id='$id'";
$result = mysqli_query($conn,$sql);

$project = mysqli_fetch_assoc($result);

?>

<h2><?php echo $project['title']; ?></h2>

<p><?php echo $project['description']; ?></p>

<p><b>Location:</b> <?php echo $project['location']; ?></p>

<p><b>Budget:</b> $<?php echo $project['budget']; ?></p>

<a href="bid_project.php?project_id=<?php echo $project['id']; ?>">
Place Bid
</a>

<?php include("includes/footer.php"); ?>