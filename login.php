<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");
include("includes/bruteforce_protection.php");

$error = "";

/* Check login attempts first */
check_login_attempts($conn);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    /* Verify CSRF token */
    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $email = clean_input($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role, is_verified FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();

        /* Verify password */
        if(password_verify($password, $user['password'])){

            /* Check if email is verified */
            if($user['is_verified'] == 0){
                $error = "Please verify your email before logging in.";
            }else{
                /* Login success */
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header("Location: dashboard.php");
                exit();
            }

        }else{
            /* Wrong password */
            record_login_attempt($conn);
            $error = "Invalid email or password.";
        }

    }else{
        /* User not found */
        record_login_attempt($conn);
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
?>

<?php include("includes/header.php"); ?>

<h2>Login</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<form method="POST">

    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

<p><a href="forgot_password.php">Forgot Password?</a></p>

<?php include("includes/footer.php"); ?>