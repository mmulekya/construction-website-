<?php
session_start();
include("config/database.php");
?>

<!DOCTYPE html>
<html>
<head>

<title>Create Constructor Profile</title>
<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<h2>Create Your Constructor Profile</h2>

<form action="save_constructor.php" method="POST">

<input type="text" name="specialization" placeholder="Specialization (e.g Mason, Engineer)" required><br><br>

<input type="number" name="experience_years" placeholder="Years of Experience" required><br><br>

<input type="text" name="city" placeholder="City" required><br><br>

<input type="text" name="country" placeholder="Country"><br><br>

<textarea name="bio" placeholder="Describe your experience"></textarea><br><br>

<button type="submit">Save Profile</button>

</form>

</body>
</html>