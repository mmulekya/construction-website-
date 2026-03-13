<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");

$id = $_GET['id'];

$sql = "SELECT blog_posts.*, users.name AS author 
        FROM blog_posts 
        JOIN users ON blog_posts.author_id = users.id
        WHERE blog_posts.id='$id'";

$result = mysqli_query($conn,$sql);
$post = mysqli_fetch_assoc($result);
?>

<h2><?php echo htmlspecialchars($post['title']); ?></h2>
<p>By <?php echo htmlspecialchars($post['author']); ?> | <?php echo $post['created_at']; ?></p>
<?php if($post['image']){ ?>
<img src="uploads/<?php echo $post['image']; ?>" width="400">
<?php } ?>
<p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

<a href="blog.php">Back to Knowledge Hub</a>

<?php include("includes/footer.php"); ?>