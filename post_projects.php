<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

$error = "";
$success = "";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!verify_csrf($_POST['csrf_token'])){
        die("Invalid CSRF token");
    }

    $title = clean_input($_POST['title']);
    $description = clean_input($_POST['description']);
    $location = clean_input($_POST['location']);
    $budget = floatval($_POST['budget']);
    $user_id = $_SESSION['user_id'];

    // Handle optional file upload
    $file_path = null;
    if(isset($_FILES['project_file']) && $_FILES['project_file']['error'] == 0){
        $allowed_types = ['image/jpeg','image/png','application/pdf'];
        if(!in_array($_FILES['project_file']['type'],$allowed_types)){
            $error = "Invalid file type.";
        } elseif($_FILES['project_file']['size'] > 5*1024*1024){
            $error = "File too large (max 5MB).";
        } else {
            $file_path = 'uploads/'.basename($_FILES['project_file']['name']);
            move_uploaded_file($_FILES['project_file']['tmp_name'],$file_path);
        }
    }

    if(empty($error)){
        $stmt = $conn->prepare("INSERT INTO projects (user_id,title,description,location,budget,file_path) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("isssds",$user_id,$title,$description,$location,$budget,$file_path);
        if($stmt->execute()){
            $success = "Project posted successfully.";
        } else {
            $error = "Failed to post project.";
        }
        $stmt->close();
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>Post a New Project</h2>

<?php if(!empty($error)){ ?>
<p style="color:red;"><?php echo e($error); ?></p>
<?php } ?>
<?php if(!empty($success)){ ?>
<p style="color:green;"><?php echo e($success); ?></p>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

<label>Title</label><br>
<input type="text" name="title" required><br><br>

<label>Description</label><br>
<textarea name="description" required></textarea><br><br>

<label>Location</label><br>
<input type="text" name="location" required><br><br>

<label>Budget (USD)</label><br>
<input type="number" name="budget" step="0.01" required><br><br>

<label>Optional File</label><br>
<input type="file" name="project_file"><br><br>

<button type="submit">Post Project</button>
</form>

<?php include("includes/footer.php"); ?>