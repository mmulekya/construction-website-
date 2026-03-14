<?php
include("includes/header.php");
include("config/database.php");
include("includes/auth.php");

if($_SESSION['role']!="admin"){
die("Access denied");
}

$result = $conn->query("SELECT * FROM reviews ORDER BY id DESC");
?>

<h2>Manage Reviews</h2>

<?php while($row=$result->fetch_assoc()){ ?>

<div class="card">

<p>Rating: <?php echo htmlspecialchars($row['rating']); ?>/5</p>

<p><?php echo htmlspecialchars($row['review']); ?></p>

<a href="delete_review.php?id=<?php echo $row['id']; ?>">Delete</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>

