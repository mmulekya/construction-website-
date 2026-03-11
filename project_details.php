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

<h3>Bids for this Project</h3>

<?php

$project_id = $_GET['id'];

$sql = "SELECT bids.*, users.name
FROM bids
JOIN users ON bids.constructor_id = users.id
WHERE project_id='$project_id'";

$result = mysqli_query($conn,$sql);

while($bid = mysqli_fetch_assoc($result)){

?>

<div class="card">

<p><b>Constructor:</b> <?php echo $bid['name']; ?></p>

<p><b>Bid Amount:</b> $<?php echo $bid['amount']; ?></p>

<p><?php echo $bid['proposal']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>