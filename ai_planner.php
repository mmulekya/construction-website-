<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$plan = [];

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $project_type = clean_input($_POST['project_type']);
    if(empty($project_type)) $error="Enter project type.";
    else $plan = [
        "Phase 1: Site preparation",
        "Phase 2: Foundation",
        "Phase 3: Structure",
        "Phase 4: Finishing"
    ];
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Project Planner</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($plan){ ?>
<ul>
<?php foreach($plan as $p) echo "<li>".e($p)."</li>"; ?>
</ul>
<?php } ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Type</label><br>
<input type="text" name="project_type" required><br><br>
<button type="submit">Get Plan</button>
</form>
<?php include("includes/footer.php"); ?>