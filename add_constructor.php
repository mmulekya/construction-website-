<?php
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
}
?>

<h2>Create Constructor Profile</h2>

<form action="save_constructor.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<label>Specialization</label>
<input type="text" name="specialization" placeholder="e.g Masonry, Electrical">

<label>Years of Experience</label>
<input type="number" name="experience">

<label>City</label>
<input type="text" name="city">

<label>Bio</label>
<textarea name="bio"></textarea>

<button type="submit">Save Profile</button>

</form>

<?php include("includes/footer.php"); ?>