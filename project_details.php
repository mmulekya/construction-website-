<?php
include("includes/header.php");
include("config/database.php");

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();
$project = $result->fetch_assoc();
?>

<h2><?php echo htmlspecialchars($project['title']); ?></h2>

<p><?php echo htmlspecialchars($project['description']); ?></p>

<p><b>Location:</b> <?php echo htmlspecialchars($project['location']); ?></p>

<p><b>Budget:</b> $<?php echo htmlspecialchars($project['budget']); ?></p>

<a href="bid_project.php?id=<?php echo $project['id']; ?>">Submit Bid</a>

<?php include("includes/footer.php"); ?>
