<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$risks = [];

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $project_type = clean_input($_POST['project_type']);
    $budget = floatval($_POST['budget']);
    if(empty($project_type) || $budget<=0) $error="Provide valid inputs.";
    else $risks = [
        "Budget overrun risk",
        "Delay in material delivery",
        "Insufficient labor allocation"
    ];
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Risk Detector</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($risks){ ?>
<ul>
<?php foreach($risks as $risk) echo "<li>".e($risk)."</li>"; ?>
</ul>
<?php } ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Type</label><br>
<input type="text" name="project_type" required><br><br>
<label>Budget (USD)</label><br>
<input type="number" name="budget" step="0.01" required><br><br>
<button type="submit">Detect Risks</button>
</form>
<?php include("includes/footer.php"); ?>