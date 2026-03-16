<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$estimate = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $area = floatval($_POST['area']);
    $complexity = clean_input($_POST['complexity']);

    if($area<=0 || empty($complexity)) $error="Invalid input.";
    else $estimate = $area*55*(($complexity==="high")?1.3:1);
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Estimator</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($estimate) echo "<p>Estimated Cost: ".e(number_format($estimate,2))." USD</p>"; ?>

<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Area (sqm)</label><br>
<input type="number" name="area" step="0.1" required><br><br>
<label>Complexity</label><br>
<select name="complexity" required>
<option value="low">Low</option>
<option value="medium">Medium</option>
<option value="high">High</option>
</select><br><br>
<button type="submit">Estimate</button>
</form>
<?php include("includes/footer.php"); ?>