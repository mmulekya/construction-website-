<?php include("includes/header.php"); ?>

<h2>Login</h2>

<form action="login_process.php" method="POST">

<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit">Login</button>

</form>

<?php include("includes/footer.php"); ?>