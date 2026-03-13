<?php

$host = "localhost";
$dbname = "buildsmart";
$username = "root";
$password = "";

try {

$conn = new mysqli($host,$username,$password,$dbname);

if ($conn->connect_error) {
die("Database connection failed");
}

$conn->set_charset("utf8mb4");

} catch(Exception $e){

die("Database error");

}

?>
<?php

$host = "sql107.infinityfree.com";
$username = "ifo_41039562";
$password = "Jan36aPr20x";
$database = "ifo_41039562_work2026";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

?>
