<?php
include("includes/header.php");
include("config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);
?>

<h2>Edit Profile</h2>

<form action="update_profile.php" method="POST" enctype="multipart/form-data">

<label>City</label>
<input type="text" name="city" value="<?php echo $user['city']; ?>">

<label>Specialization</label>
<input type="text" name="specialization" value="<?php echo $user['specialization']; ?>">

<label>Experience (Years)</label>
<input type="number" name="experience" value="<?php echo $user['experience']; ?>">

<label>Bio</label>
<textarea name="bio"><?php echo $user['bio']; ?></textarea>

<label>Profile Photo</label>
<input type="file" name="photo">

<button type="submit">Update Profile</button>

</form>

<?php include("includes/footer.php"); ?>
