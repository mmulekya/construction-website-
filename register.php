<?php
include("includes/security.php");
include("includes/header.php");
?>

<h2>Create Account</h2>

<form action="register_process.php" method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<label>Account Type</label>
<select name="role" required>
<option value="client">Client</option>
<option value="constructor">Constructor</option>
</select>

<label>Country</label>
<select name="country" required>

<option value="Kenya">Kenya</option>
<option value="Tanzania">Tanzania</option>
<option value="Uganda">Uganda</option>
<option value="Rwanda">Rwanda</option>
<option value="USA">United States</option>
<option value="UK">United Kingdom</option>
<option value="India">India</option>

</select>

<button type="submit">Register</button>

</form>

<?php include("includes/footer.php"); ?>
