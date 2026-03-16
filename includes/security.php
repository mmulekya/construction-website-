<?php
session_start();

// Regenerate session ID to prevent fixation
if(!isset($_SESSION['initiated'])){
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Login check function
function check_login(){
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
}

// Clean input
function clean_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Escape output
function e($string){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>