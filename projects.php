<?php

include("config/database.php");

$sql = "SELECT * FROM projects ORDER BY created_at DESC";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>Construction Projects</title>
</head>

<body>

<h2>Available Projects</h2>

<?php

while($row = mysqli_fetch_assoc($result)){

echo "<h3>".$row['title']."</h3>";
echo "<p>".$row['description']."</p>";
echo "<p>Location: ".$row['location']."</p>";
echo "<p>Budget: ".$row['budget']."</p>";
echo "<hr>";
echo "<a href='bid_project.php?project_id=".$row['id']."'>Submit Bid</a>";

}

?>

</body>
</html>