<?php

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_token(){
    return $_SESSION['csrf_token'];
}

function verify_csrf($token){
    if ($token !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }
}

?>
