<?php
include("config/database.php");
include("includes/security.php");
check_login();

$error = "";
$total_cost = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $area = floatval($_POST['area']);
    $rate = floatval($_POST['rate']);
    if($area<=0 || $rate<=0) $error="Invalid input.";
    else $total_cost = $area * $rate;
}

include("includes/header.php"); 
?>
<h2>Cost Calculator</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($total_cost) echo "<p>Total Cost: ".e(number_format($total_cost,2))." USD</p>"; ?>
<form method="POST">
<label>Area (sqm)</label><br>
<input type="number" name="area" step="0.1" required><br><br>
<label>Rate (USD per sqm)</label><br>
<input type="number" name="rate" step="0.01" required><br><br>
<button type="submit">Calculate</button>
</form>
<?php include("includes/footer.php"); ?>