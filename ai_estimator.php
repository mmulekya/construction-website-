<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

check_login(); // ensure user is logged in

$error = "";
$estimate_result = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $area = floatval($_POST['area']);
    $materials = clean_input($_POST['materials']);
    $complexity = clean_input($_POST['complexity']);
    $location = clean_input($_POST['location']);

    if($area <= 0 || empty($materials) || empty($complexity) || empty($location)){
        $error = "Please fill all fields correctly.";
    } else {
        // Placeholder for AI API integration
        // $estimate_result = callAIEstimateAPI($area, $materials, $complexity, $location);

        // For demo, using formula
        $base_cost = 50; // per sqm
        $material_multiplier = ($materials === "premium") ? 1.5 : 1;
        $complexity_multiplier = ($complexity === "high") ? 1.3 : 1;
        $location_multiplier = ($location === "UK") ? 1.2 : 1;

        $estimate_result = $area * $base_cost * $material_multiplier * $complexity_multiplier * $location_multiplier;
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>AI Project Cost Estimator</h2>

<?php if(!empty($error)) { ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<?php if(!empty($estimate_result)) { ?>
<p>Estimated Project Cost: <?php echo e(number_format($estimate_result,2)); ?> USD</p>
<?php } ?>

<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

<label>Project Area (sqm)</label><br>
<input type="number" name="area" step="0.1" required><br><br>

<label>Materials</label><br>
<select name="materials" required>
    <option value="standard">Standard</option>
    <option value="premium">Premium</option>
</select><br><br>

<label>Complexity</label><br>
<select name="complexity" required>
    <option value="low">Low</option>
    <option value="medium">Medium</option>
    <option value="high">High</option>
</select><br><br>

<label>Location</label><br>
<input type="text" name="location" required><br><br>

<button type="submit">Get Estimate</button>
</form>

<?php include("includes/footer.php"); ?>