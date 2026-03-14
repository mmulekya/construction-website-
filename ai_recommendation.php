<?php
include("includes/header.php");
include("config/database.php");

$type = htmlspecialchars($_POST['project_type']);
$location = htmlspecialchars($_POST['location']);

$stmt = $conn->prepare(
"SELECT * FROM users 
WHERE role='constructor' 
ORDER BY experience DESC
LIMIT 5"
);

$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Recommended Constructors</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<h3><?php echo htmlspecialchars($row['name']); ?></h3>

<p>Experience: <?php echo htmlspecialchars($row['experience']); ?> years</p>

<a href="profile.php?id=<?php echo $row['id']; ?>">
View Profile
</a>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>

