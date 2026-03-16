<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");
check_login();

$project_id = intval($_GET['id'] ?? 0);
if($project_id <= 0) die("Invalid project ID");

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");
    $bid_amount = floatval($_POST['bid_amount']);
    if($bid_amount <= 0) $error="Enter a valid bid.";
    else {
        $stmt = $conn->prepare("INSERT INTO project_bids (user_id, project_id, amount, created_at) VALUES (?,?,?,NOW())");
        $stmt->bind_param("iid", $_SESSION['user_id'], $project_id, $bid_amount);
        $stmt->execute();
        $stmt->close();
        $success = "Your bid has been placed.";
    }
}

include("includes/header.php"); 
?>
<h2>Place a Bid</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".e($success)."</p>"; ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Bid Amount (USD)</label><br>
<input type="number" name="bid_amount" step="0.01" required><br><br>
<button type="submit">Submit Bid</button>
</form>
<?php include("includes/footer.php"); ?>