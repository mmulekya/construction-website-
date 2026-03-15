<?php
include("includes/header.php");
include("config/database.php");
include("includes/security.php"); 
require_login();

$success = '';
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $user_id = $_SESSION['user_id'];

    // Basic validation
    if(empty($name) || empty($email) || empty($message)){
        $error = "All fields are required.";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email address.";
    } else {
        // Prepared statement to insert safely
        $stmt = $conn->prepare("INSERT INTO contact_messages (user_id, name, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $name, $email, $message);

        if($stmt->execute()){
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Failed to send message. Please try again later.";
        }
        $stmt->close();
    }
}
?>

<h2>Contact Us</h2>

<?php if($success) echo "<p style='color:green;'>$success</p>"; ?>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Message:</label><br>
    <textarea name="message" rows="6" required></textarea><br>

    <button type="submit">Send Message</button>
</form>

<?php include("includes/footer.php"); ?>