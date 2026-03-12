<?php
include("includes/header.php");
include("config/database.php");

<form method="GET">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<input type="text" name="city" placeholder="Search by city">

<select name="specialization">
<option value="">All Specializations</option>
<option value="architect">Architect</option>
<option value="engineer">Engineer</option>
<option value="builder">Builder</option>
<option value="contractor">Contractor</option>
</select>

<button type="submit">Search</button>

</form>

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