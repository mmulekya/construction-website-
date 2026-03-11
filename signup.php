 <?php include("includes/header.php"); ?>

<h2>Create Account</h2>

<form action="signup_process.php" method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<label>Role</label>
<select name="role">
<option value="client">Client</option>
<option value="constructor">Constructor</option>
</select>

<button type="submit">Signup</button>

</form>

<?php include("includes/footer.php"); ?>