<?php
include("config/database.php");

$message = "";

if(isset($_GET['token'])){
    $token = $_GET['token'];

    $stmt = $conn->prepare(
        "SELECT id FROM users WHERE verification_token=? AND is_verified=0"
    );

    $stmt->bind_param("s",$token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $stmt = $conn->prepare(
            "UPDATE users SET is_verified=1, verification_token=NULL WHERE verification_token=?"
        );

        $stmt->bind_param("s",$token);
        $stmt->execute();

        $message = "Account verified successfully. You can now login.";

    }else{
        $message = "Invalid or expired verification link.";
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>Email Verification</h2>

<p><?php echo $message; ?></p>

<a href="login.php">Go to Login</a>

<?php include("includes/footer.php"); ?>