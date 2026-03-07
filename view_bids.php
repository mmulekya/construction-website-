<?php

include("config/database.php");

$project_id = $_GET['project_id'];

$sql = "SELECT * FROM bids WHERE project_id='$project_id'";
$result = mysqli_query($conn,$sql);

echo "<h2>Bids for this project</h2>";

while($row = mysqli_fetch_assoc($result)){

echo "<p>Price: ".$row['price']."</p>";
echo "<p>Proposal: ".$row['proposal']."</p>";
echo "<hr>";

}

?>