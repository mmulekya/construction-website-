<?php
include("includes/header.php");
include("config/database.php");

$project_id = intval($_GET['project_id']);

$stmt = $conn->prepare(
"SELECT * FROM project_progress 
WHERE project_id=? 
ORDER BY id DESC"
);

$stmt->bind_param("i",$project_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<h2>Project Progress</h2>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card">

<h3><?php echo htmlspecialchars($row['stage']); ?></h3>

<p><b>Progress:</b> <?php echo htmlspecialchars($row['progress']); ?>%</p>

<p><?php echo htmlspecialchars($row['description']); ?></p>

<?php if($row['photo']!=""){ ?>

<img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" width="300">

<?php } ?>

</div>

<?php } ?>

<?php include("includes/footer.php"); ?>