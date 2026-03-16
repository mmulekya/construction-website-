<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login();

$error = "";
$budget_prediction = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");

    $area = floatval($_POST['area']);
    $complexity = clean_input($_POST['complexity']);
    $location = clean_input($_POST['location']);

    if($area <= 0 || empty($complexity) || empty($location)){
        $error = "Please provide valid input for all fields.";
    } else {
        // Placeholder: replace with real AI prediction
        $budget_prediction = $area * 50 * (($complexity==="high")?1.3:1) * (($location==="UK")?1.2:1);
    }
}
?>

<?php include("includes/header.php"); ?>
<h2>AI Budget Predictor</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($budget_prediction) echo "<p>Predicted Budget: ".e(number_format($budget_prediction,2))." USD</p>"; ?>

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

<label>Location</label><br>
<input type="text" name="location" required><br><br>

<button type="submit">Predict Budget</button>
</form>
<?php include("includes/footer.php"); ?>