<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_message_rate(){

    $limit = 2; // seconds between messages

    if(isset($_SESSION['last_message_time'])){

        $diff = time() - $_SESSION['last_message_time'];

        if($diff < $limit){
            die("You are sending messages too fast.");
        }
    }

    $_SESSION['last_message_time'] = time();
}
?>