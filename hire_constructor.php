<?php

session_start();
include("config/database.php");

$constructor_id = $_GET['constructor_id'];
$project_id = $_GET['project_id'];

$sql = "UPDATE projects 
        SET constructor_id='$constructor_id', status='assigned'
        WHERE id='$project_id'";

mysqli_query($conn,$sql);

echo "<h3>Constructor successfully assigned to project!</h3>";

echo "<a href='project_details.php?id=".$project_id."'>Back to Project</a>";

?>
