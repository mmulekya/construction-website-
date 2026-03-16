<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Regenerate session ID once */
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

/* Bind session to IP and browser */
if (!isset($_SESSION['user_ip'])) {
    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

if (
    $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] ||
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']
) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

/* Require login */
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

/* Check login status */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/* Escape output (XSS protection) */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/* Clean input */
function clean_input($data){
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>