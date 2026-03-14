<?php
require_once "includes/security.php";
require_constructor();
include("includes/header.php");
include("config/database.php");

// Only logged-in constructors can apply
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'constructor'){
    die("Access denied. Only constructors can apply to projects.");
}

// Get project ID from GET request
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($project_id <= 0){
    die("Invalid project ID.");
}

$constructor_id = $_SESSION['user_id'];

// Check if already applied
$stmt = $conn->prepare(
    "SELECT * FROM project_applications WHERE project_id = ? AND constructor_id = ?"
);
$stmt->bind_param("ii", $project_id, $constructor_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    die("You have already applied to this project.");
}
$stmt->close();

// Insert application
$stmt = $conn->prepare(
    "INSERT INTO project_applications (project_id, constructor_id) VALUES (?, ?)"
);
$stmt->bind_param("ii", $project_id, $constructor_id);
$stmt->execute();
$stmt->close();

echo "<p class='success'>Application submitted successfully!</p>";
echo "<p><a href='project_details.php?id=".$project_id."'>Back to Project</a></p>";

include("includes/footer.php");
?>