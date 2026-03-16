<?php
include("config/database.php");
include("includes/csrf.php");

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $name = clean_input($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message_text = clean_input($_POST['message']);

    if(empty($name) || empty($email) || empty($message_text)){
        $error = "All fields are required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email address.";
    } else {
        $subject = "Contact Form Message from BuildSmart";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message_text";
        $headers = "From: no-reply@yourdomain.com";

        if(mail("support@yourdomain.com",$subject,$body,$headers)){
            $success = "Message sent successfully!";
        } else {
            $error = "Failed to send message. Please try again later.";
        }
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>Contact Us</h2>

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

<label>Message</label><br>
<textarea name="message" required></textarea><br><br>

<button type="submit">Send Message</button>
</form>

<?php include("includes/footer.php"); ?>