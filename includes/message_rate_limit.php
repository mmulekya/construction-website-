<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* --------------------------
MESSAGE RATE LIMIT
---------------------------*/

$max_messages = 10;     // max messages allowed
$time_window = 60;      // time window in seconds (1 minute)

if (!isset($_SESSION['message_count'])) {
    $_SESSION['message_count'] = 0;
}

if (!isset($_SESSION['message_time'])) {
    $_SESSION['message_time'] = time();
}

$current_time = time();
$elapsed = $current_time - $_SESSION['message_time'];

if ($elapsed > $time_window) {
    $_SESSION['message_count'] = 0;
    $_SESSION['message_time'] = $current_time;
}

if ($_SESSION['message_count'] >= $max_messages) {
    die("You are sending messages too fast. Please wait a moment.");
}

$_SESSION['message_count']++;

?>