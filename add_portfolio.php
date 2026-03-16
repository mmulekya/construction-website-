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
    $description = clean_input($_POST['description']);
    $image = $_FILES['image'] ?? null;

    if(empty($title) || empty($description) || !$image) $error="All fields required.";
    else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $allowed = ["jpg","jpeg","png"];
        if(!in_array(strtolower($ext),$allowed)) $error="Invalid image type.";
        else {
            $target = "uploads/portfolio/".time()."_".basename($image['name']);
            if(move_uploaded_file($image['tmp_name'],$target)){
                $stmt = $conn->prepare("INSERT INTO portfolio (title,description,image,created_at) VALUES (?,?,?,NOW())");
                $stmt->bind_param("sss",$title,$description,$target);
                $stmt->execute();
                $stmt->close();
                $success="Portfolio added successfully.";
            } else $error="Image upload failed.";
        }
    }
}

include("includes/header.php"); 
?>
<h2>Add Portfolio Item</h2>
<?php if($error) echo "<p style='color:red;'>".e($error)."</p>"; ?>
<?php if($success) echo "<p style='color:green;'>".e($success)."</p>"; ?>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<label>Title</label><br>
<input type="text" name="title" required><br><br>
<label>Description</label><br>
<textarea name="description" rows="4" required></textarea><br><br>
<label>Image</label><br>
<input type="file" name="image" required><br><br>
<button type="submit">Add Portfolio</button>
</form>
<?php include("includes/footer.php"); ?>