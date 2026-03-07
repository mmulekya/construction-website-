<?php
session_start();
include("config/database.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Post Construction Project</title>
</head>

<body>

<h2>Post Your Construction Project</h2>

<form action="save_project.php" method="POST">

<input type="text" name="title" placeholder="Project Title" required><br><br>

<textarea name="description" placeholder="Describe your project"></textarea><br><br>

<input type="text" name="location" placeholder="Location"><br><br>

<input type="number" name="budget" placeholder="Estimated Budget"><br><br>

<button type="submit">Post Project</button>

</form>

</body>
</html>