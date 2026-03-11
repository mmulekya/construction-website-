<?php

include("includes/header.php");
include("config/database.php");

$sql = "SELECT * FROM projects ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

?>

<h2>Construction Projects</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<h3><?php echo $row['title']; ?></h3>

<p><?php echo substr($row['description'],0,120); ?>...</p>

<p><b>Location:</b> <?php echo $row['location']; ?></p>

<p><b>Budget:</b> $<?php echo $row['budget']; ?></p>

<a href="project_details.php?id=<?php echo $row['id']; ?>">
View Details
</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>