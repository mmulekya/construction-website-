<?php
include("includes/header.php");
include("config/database.php");
include("includes/auth.php");

if($_SESSION['role']!="admin"){
die("Access denied");
}

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<h2>Manage Projects</h2>

<?php while($row=$result->fetch_assoc()){ ?>

<div class="card">

<h3><?php echo htmlspecialchars($row['title']); ?></h3>

<p><?php echo htmlspecialchars($row['description']); ?></p>

<a href="delete_project.php?id=<?php echo $row['id']; ?>">Delete</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>


