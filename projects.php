<?php
include("includes/header.php");
include("config/database.php");
include("includes/currency.php"); // Our final currency system

/* Get the user's country from session (default to USA if not set) */
$user_country = $_SESSION['country'] ?? 'USA';

/* Fetch all projects ordered by newest first */
$stmt = $conn->prepare("SELECT id, title, description, location, budget FROM projects ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();

if(!$result || $result->num_rows === 0){
    echo "<p>No projects found.</p>";
    exit();
}
?>

<h2>Available Construction Projects</h2>

<?php while($row = $result->fetch_assoc()){ ?>
<div class="card">

    <h3><?php echo htmlspecialchars($row['title']); ?></h3>

    <p><?php echo htmlspecialchars($row['description']); ?></p>

    <p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>

    <!-- Display budget in the user's local currency using the final currency system -->
    <p><b>Budget:</b> <?php echo convert_currency($row['budget'], $user_country); ?></p>

    <a href="project_details.php?id=<?php echo $row['id']; ?>">View Details</a>

</div>
<?php } ?>

<?php
$stmt->close();
include("includes/footer.php");
?>