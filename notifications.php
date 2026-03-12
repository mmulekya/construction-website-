<?php
include("includes/header.php");
include("config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notifications 
        WHERE user_id='$user_id' 
        ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);
?>

<h2>Notifications</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<p><?php echo $row['message']; ?></p>

<a href="<?php echo $row['link']; ?>">View</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>