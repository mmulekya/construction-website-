<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

// Only logged-in clients can post projects
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'client'){
    die("Access denied. Only clients can post projects.");
}

// Handle form submission
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);
    $location = sanitize($_POST['location']);
    $budget = floatval($_POST['budget']); // ensure numeric
    $user_id = $_SESSION['user_id'];

    // Prepare and execute insert
    $stmt = $conn->prepare(
        "INSERT INTO projects (title, description, location, budget, user_id) 
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssdi", $title, $description, $location, $budget, $user_id);
    $stmt->execute();
    $stmt->close();

    $success_message = "Project posted successfully!";
}
?>

<h2>Post a New Construction Project</h2>

<?php if(isset($success_message)) echo "<p class='success'>".htmlspecialchars($success_message)."</p>"; ?>

<form method="POST">

    <label>Project Title</label>
    <input type="text" name="title" required>

    <label>Project Description</label>
    <textarea name="description" required></textarea>

    <label>Project Location</label>
    <input type="text" name="location" required value="<?php echo htmlspecialchars($_SESSION['country']); ?>">

    <label>Project Budget (USD)</label>
    <input type="number" name="budget" step="0.01" required>

    <button type="submit">Post Project</button>
</form>

<?php include("includes/footer.php"); ?>