<?php

require_once "includes/security.php";
require_once "includes/bruteforce_protection.php";

$email = sanitize($_POST['email']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id,password FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){

    if(password_verify($password,$user['password'])){

        reset_login_attempts(); // success
        $_SESSION['user_id']=$user['id'];
        header("Location: dashboard.php");
        exit();

    } else {

        record_failed_login();
        echo "Invalid login.";

    }

}else{

    record_failed_login();
    echo "Invalid login.";

}
?>