<?php

include("config/database.php");

$sql = "SELECT * FROM constructors";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Constructors - BuildSmart</title>

</head>

<body>

<h2>Available Constructors</h2>

<?php

while($row = mysqli_fetch_assoc($result)){

echo "<h3>".$row['specialization']."</h3>";
echo "<p>Experience: ".$row['experience_years']." years</p>";
echo "<p>City: ".$row['city']."</p>";
echo "<p>".$row['bio']."</p>";
echo "<hr>";

}

?>

</body>
</html>