<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");
require_once "includes/security.php";
require_login();

$project_id = intval($_GET['project_id']);
?>

<h2>Project Payment</h2>

<form action="process_payment.php" method="POST">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Payment Amount (USD)</label>
<input type="number" name="amount" required>

<label>Payment Method</label>

<select name="method">

<option value="mpesa">M-Pesa</option>
<option value="paypal">PayPal</option>
<option value="stripe">Stripe</option>

</select>

<button type="submit">Pay Now</button>

</form>

<?php include("includes/footer.php"); ?>
