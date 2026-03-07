<!DOCTYPE html>
<html>
<head>

<title>Signup - BuildSmart</title>
<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<h2>Create Account</h2>

<form action="signup_process.php" method="POST">

<input type="text" name="name" placeholder="Full Name" required><br><br>

<input type="email" name="email" placeholder="Email" required><br><br>

<input type="password" name="password" placeholder="Password" required><br><br>

<select name="role">
<option value="client">Client</option>
<option value="constructor">Constructor</option>
</select><br><br>

<input type="text" name="country" placeholder="Country"><br><br>

<button type="submit">Register</button>

</form>

</body>
</html>