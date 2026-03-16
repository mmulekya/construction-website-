<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");
check_login();
check_admin();

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!verify_csrf($_POST['csrf_token'])) die("Invalid CSRF token");
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);

    if(empty($title) || empty($content)) $error="Fill all fields.";
    else {
        $stmt = $conn->prepare("INSERT INTO blog_posts (title,content,created_at) VALUES (?,?,NOW())");
        $stmt->bind_param("ss",$title,$content);
        $stmt->execute();
        $stmt->close();
        $success="Blog post added successfully.";
    }
}

include("includes/header.php"); 
?>
<h2>Add Blog Post</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".e($success)."</p>"; ?>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Title</label><br>
<input type="text" name="title" required><br><br>
<label>Content</label><br>
<textarea name="content" rows="5" required></textarea><br><br>
<button type="submit">Add Post</button>
</form>
<?php include("includes/footer.php"); ?>