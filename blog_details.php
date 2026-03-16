<?php
include("config/database.php");
include("includes/security.php");

$post_id = intval($_GET['id'] ?? 0);
if($post_id <= 0) die("Invalid post ID");

$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id=? LIMIT 1");
$stmt->bind_param("i",$post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
$stmt->close();
if(!$post) die("Post not found");

include("includes/header.php"); 
?>
<h2><?php echo e($post['title']); ?></h2>
<p><?php echo e($post['content']); ?></p>
<?php include("includes/footer.php"); ?>