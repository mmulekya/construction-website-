<?php
include("config/database.php");

$project_type = $_GET['type'];

$sql = "SELECT * FROM constructors 
WHERE specialization LIKE '%$project_type%' 
ORDER BY experience DESC 
LIMIT 5";

$result = mysqli_query($conn,$sql);

echo "<h2>Recommended Constructors</h2>";

while($row = mysqli_fetch_assoc($result)){
echo "<p>";
echo "<strong>".$row['name']."</strong><br>";
echo "Experience: ".$row['experience']." years<br>";
echo "Specialization: ".$row['specialization'];
echo "</p>";
}
?>