<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$recommendations = [];

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $project_type = clean_input($_POST['project_type']);
    if(empty($project_type)) $error="Enter project type.";
    else $recommendations = [
        "Use reinforced concrete for foundations",
        "Consider modular construction techniques",
        "Include energy-efficient materials"
    ];
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Recommendations</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($recommendations){ ?>
<ul>
<?php foreach($recommendations as $r) echo "<li>".e($r)."</li>"; ?>
</ul>
<?php } ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Type</label><br>
<input type="text" name="project_type" required><br><br>
<button type="submit">Get Recommendations</button>
</form>
<?php include("includes/footer.php"); ?>