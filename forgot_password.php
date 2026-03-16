<?php
include("config/database.php");
include("includes/csrf.php");

$message = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $stmt = $conn->prepare("SELECT id, name FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE id=?");
        $stmt->bind_param("ssi",$token,$expires,$user['id']);
        $stmt->execute();

        $reset_link = "https://yourdomain.com/reset_password.php?token=".$token;

        $subject = "Reset Your BuildSmart Password";
        $message_body = "
Hello {$user['name']},

You requested a password reset. Click the link below to reset your password:

$reset_link

If you did not request this, ignore this email.
";
        $headers = "From: no-reply@yourdomain.com";

        mail($email,$subject,$message_body,$headers);

        $message = "Check your email for a password reset link.";

    }else{
        $error = "Email not found.";
    }

    $stmt->close();
}
?>

<?php include("includes/header.php"); ?>

<h2>Forgot Password</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<?php if(!empty($message)){ ?>
<p style="color:green;"><?php echo e($message); ?></p>
<?php } ?>

<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Email</label><br>
<input type="email" name="email" required><br><br>
<button type="submit">Send Reset Link</button>
</form>

<?php include("includes/footer.php"); ?>