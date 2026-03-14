<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

// Only clients can view applicants
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client'){
    die("Access denied. Only clients can view applicants.");
}

// Get project ID
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch applicants
$stmt = $conn->prepare("
    SELECT u.id, u.name, u.country
    FROM project_applications pa
    JOIN users u ON pa.constructor_id = u.id
    WHERE pa.project_id=?
");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Applicants for Project</h2>

<?php while($applicant = $result->fetch_assoc()){ ?>
<div class="card">
    <h3><?php echo htmlspecialchars($applicant['name']); ?></h3>
    <p>Country: <?php echo htmlspecialchars($applicant['country']); ?></p>
    <a href="chat.php?project_id=<?php echo $project_id; ?>&user_id=<?php echo $applicant['id']; ?>">Chat with Applicant</a>
</div>
<?php } ?>

<?php
$stmt->close();
include("includes/footer.php");
?>