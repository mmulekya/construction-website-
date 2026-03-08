<h2>Make Payment</h2>

<form action="process_payment.php" method="POST">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
<input type="hidden" name="constructor_id" value="<?php echo $constructor_id; ?>">

<label>Amount</label>
<input type="number" name="amount" required>

<button type="submit">Pay Now</button>

</form>