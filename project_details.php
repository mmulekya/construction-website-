<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");
include("includes/currency.php");

// Get project ID from GET request
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($project_id <= 0){
    die("Invalid project ID.");
}

// Fetch project details
$stmt = $conn->prepare(
    "SELECT p.*, u.name AS client_name, u.country AS client_country
     FROM projects p
     JOIN users u ON p.user_id = u.id
     WHERE p.id = ?"
);
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0){
    die("Project not found.");
}

$project = $result->fetch_assoc();

// User country for currency display
$user_country = $_SESSION['country'] ?? 'USA';

$stmt->close();
?>

<h2><?php echo htmlspecialchars($project['title']); ?></h2>

<p><b>Description:</b> <?php echo htmlspecialchars($project['description']); ?></p>

<p><b>Location:</b> <?php echo htmlspecialchars($project['location']); ?></p>

<p><b>Budget:</b> <?php echo convert_currency($project['budget'], $user_country); ?></p>

<p><b>Posted By:</b> <?php echo htmlspecialchars($project['client_name']); ?> (<?php echo htmlspecialchars($project['client_country']); ?>)</p>

<!-- Placeholder for future constructor assignment or messaging -->
<?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'constructor'): ?>
    <a href="apply_project.php?id=<?php echo $project['id']; ?>">Apply to this Project</a>
<?php endif; ?>

<?php include("includes/footer.php"); ?>