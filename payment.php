<?php
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$project_id = $_GET['project_id'];
$constructor_id = $_GET['constructor_id'];

?>

<h2>Make Payment</h2>

<form action="process_payment.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
<input type="hidden" name="constructor_id" value="<?php echo $constructor_id; ?>">

<label>Amount (USD)</label>
<input type="number" name="amount" required>

<label>Payment Method</label>
<select name="method">
<option value="mpesa">Mpesa</option>
<option value="paypal">PayPal</option>
<option value="bank">Bank Transfer</option>
</select>

<button type="submit">Pay Now</button>

</form>

<?php include("includes/footer.php"); ?>