<?php
include("includes/header.php");
include("config/database.php");
?>

<h2>Available Construction Projects</h2>

<?php

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");

while($row = $result->fetch_assoc()){

?>

<div class="card">

<h3><?php echo htmlspecialchars($row['title']); ?></h3>

<p><?php echo htmlspecialchars($row['description']); ?></p>

<p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>

<p><b>Budget:</b> $<?php echo htmlspecialchars($row['budget']); ?></p>

<a href="project_details.php?id=<?php echo $row['id']; ?>">View Details</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>