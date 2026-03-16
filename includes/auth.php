<?php
include_once "security.php";

/* Require login */
function require_auth(){
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
}

/* Require admin */
function require_admin(){
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
        die("Access denied.");
    }
}
?>