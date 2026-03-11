<?php
include("includes/header.php");
include("config/database.php");

$sql = "SELECT users.name, constructors.specialization, constructors.experience, constructors.city, constructors.bio
FROM constructors
JOIN users ON constructors.user_id = users.id";

$result = mysqli_query($conn,$sql);
?>

<h2>Available Constructors</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

<h3><?php echo $row['name']; ?></h3>

<p><b>Specialization:</b> <?php echo $row['specialization']; ?></p>

<p><b>Experience:</b> <?php echo $row['experience']; ?> years</p>

<p><b>City:</b> <?php echo $row['city']; ?></p>

<p><?php echo $row['bio']; ?></p>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>