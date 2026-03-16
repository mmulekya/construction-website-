<?php

include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(!verify_csrf($_POST['csrf_token'])){
die("Invalid CSRF token");
}

$name = clean_input($_POST['name']);
$email = clean_input($_POST['email']);
$password = $_POST['password'];
$role = clean_input($_POST['role']);

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
$error = "Invalid email address.";
}

/* Check existing email */
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
$error = "Email already registered.";
}

$stmt->close();

if(empty($error)){

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

/* Create verification token */
$token = bin2hex(random_bytes(32));

$stmt = $conn->prepare(
"INSERT INTO users (name,email,password,role,verification_token,is_verified)
VALUES (?,?,?,?,?,0)"
);

$stmt->bind_param("sssss",$name,$email,$hashed_password,$role,$token);

if($stmt->execute()){

$verify_link = "https://yourdomain.com/verify.php?token=".$token;

$subject = "Verify your BuildSmart account";

$message = "
Hello $name,

Please verify your account by clicking the link below:

$verify_link

If you did not register, ignore this email.
";

$headers = "From: no-reply@yourdomain.com";

mail($email,$subject,$message,$headers);

$success = "Account created! Check your email to verify your account.";

}else{
$error = "Registration failed.";
}

$stmt->close();

}

}

?>

<?php include("includes/header.php"); ?>

<h2>Signup</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>

<?php if(!empty($success)){ ?>
<p style="color:green;"><?php echo e($success); ?></p>
<?php } ?>

<form method="POST">

<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

<label>Name</label><br>
<input type="text" name="name" required><br><br>

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

<label>Account Type</label><br>
<select name="role" required>
<option value="client">Client</option>
<option value="constructor">Constructor</option>
</select><br><br>

<button type="submit">Create Account</button>

</form>

<?php include("includes/footer.php"); ?>