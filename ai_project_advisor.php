<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$advice = [];

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $budget = floatval($_POST['budget']);
    if($budget<=0) $error="Enter valid budget.";
    else $advice = [
        "Hire certified contractors",
        "Prioritize critical tasks first",
        "Use cost-effective materials"
    ];
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Project Advisor</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($advice){ ?>
<ul>
<?php foreach($advice as $a) echo "<li>".e($a)."</li>"; ?>
</ul>
<?php } ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Budget (USD)</label><br>
<input type="number" name="budget" step="0.01" required><br><br>
<button type="submit">Get Advice</button>
</form>
<?php include("includes/footer.php"); ?>