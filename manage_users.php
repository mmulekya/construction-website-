<?php
include("includes/header.php");
include("config/database.php");
include("includes/auth.php");

if($_SESSION['role']!="admin"){
die("Access denied");
}

$result = $conn->query("SELECT id,name,email,role FROM users ORDER BY id DESC");
?>

<h2>Manage Users</h2>

<?php while($row=$result->fetch_assoc()){ ?>

<div class="card">

<p><b>Name:</b> <?php echo htmlspecialchars($row['name']); ?></p>

<p><b>Email:</b> <?php echo htmlspecialchars($row['email']); ?></p>

<p><b>Role:</b> <?php echo htmlspecialchars($row['role']); ?></p>

<a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>