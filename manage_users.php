<?php
include("config/database.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn,$sql);

echo "<h2>All Users</h2>";

while($row = mysqli_fetch_assoc($result)){
echo $row['name']." - ".$row['role'];
echo "<br>";
}
?>