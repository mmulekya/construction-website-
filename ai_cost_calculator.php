<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$calculated_cost = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $materials = clean_input($_POST['materials']);
    $area = floatval($_POST['area']);

    if($area<=0 || empty($materials)) $error="Invalid input.";
    else $calculated_cost = $area*50*(($materials==="premium")?1.5:1);
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Cost Calculator</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($calculated_cost) echo "<p>Calculated Cost: ".e(number_format($calculated_cost,2))." USD</p>"; ?>

<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Project Area (sqm)</label><br>
<input type="number" name="area" step="0.1" required><br><br>
<label>Materials</label><br>
<select name="materials" required>
<option value="standard">Standard</option>
<option value="premium">Premium</option>
</select><br><br>
<button type="submit">Calculate Cost</button>
</form>
<?php include("includes/footer.php"); ?>