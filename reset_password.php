<?php
include("config/database.php");
include("includes/csrf.php");

$error = "";
$success = "";

if(isset($_GET['token'])){
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expires > NOW()");
    $stmt->bind_param("s",$token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(!verify_csrf($_POST['csrf_token'])){
                die("Invalid CSRF token");
            }

            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE id=?");
            $stmt->bind_param("si",$hashed_password,$user['id']);
            $stmt->execute();

            $success = "Password reset successfully. You can now login.";
        }

    }else{
        $error = "Invalid or expired token.";
    }
}else{
    $error = "No token provided.";
}
?>

<?php include("includes/header.php"); ?>

<h2>Reset Password</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<?php if(!empty($success)){ ?>
<p style="color:green;"><?php echo e($success); ?></p>
<p><a href="login.php">Go to Login</a></p>
<?php } ?>

<?php if(empty($success) && (empty($error) || !empty($user))){ ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>New Password</label><br>
<input type="password" name="password" required><br><br>
<button type="submit">Reset Password</button>
</form>
<?php } ?>

<?php include("includes/footer.php"); ?>