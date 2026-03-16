<?php

function check_login_attempts($conn){

$ip = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare(
"SELECT COUNT(*) FROM login_attempts 
WHERE ip_address=? 
AND attempt_time > (NOW() - INTERVAL 10 MINUTE)"
);

$stmt->bind_param("s",$ip);
$stmt->execute();
$stmt->bind_result($attempts);
$stmt->fetch();
$stmt->close();

if($attempts >= 5){
die("Too many login attempts. Try again in 10 minutes.");
}

}

function record_login_attempt($conn){

$ip = $_SERVER['REMOTE_ADDR'];

$stmt = $conn->prepare(
"INSERT INTO login_attempts (ip_address) VALUES (?)"
);

$stmt->bind_param("s",$ip);
$stmt->execute();
$stmt->close();

}

?>