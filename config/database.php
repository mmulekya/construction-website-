<?php

$host = "sql107.infinityfree.com";
$user = "ifo_41039562";
$pass = "Jan36aPr20x";
$dbname = "ifo_41039562_work2026";

$conn = new mysqli($host,$user,$pass,$dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Set charset for security
$conn->set_charset("utf8mb4");
?>
