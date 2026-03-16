<?php
include_once "security.php";

/* Require authentication */
function require_auth(){
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
}

/* Require admin role */
function require_admin(){
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
        die("Access denied.");
    }
}
?>