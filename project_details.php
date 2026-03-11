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

<a href="chat.php?project_id=<?php echo $project_id; ?>&user=<?php echo $bid['constructor_id']; ?>">
Chat with Constructor
</a>

<h3>Project Updates</h3>

<?php

$sql = "SELECT project_updates.*, users.name
FROM project_updates
JOIN users ON project_updates.constructor_id = users.id
WHERE project_id='$project_id'
ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

while($update = mysqli_fetch_assoc($result)){

?>

<div class="card">

<p><b><?php echo $update['name']; ?></b></p>

<p><?php echo $update['update_text']; ?></p>

<p><small><?php echo $update['created_at']; ?></small></p>

</div>

<?php } ?>

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

<a href="update_project.php?project_id=<?php echo $project_id; ?>">
Add Project Update
</a>

<?php } ?>

<?php include("includes/footer.php"); ?>