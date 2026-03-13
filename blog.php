<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");
?>

<h2>Construction Knowledge Hub</h2>

<a href="add_blog.php">Add New Post</a>

<?php
$sql = "SELECT blog_posts.*, users.name AS author 
        FROM blog_posts 
        JOIN users ON blog_posts.author_id = users.id
        ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>

<div class="card">
<h3><?php echo htmlspecialchars($row['title']); ?></h3>
<p>By <?php echo htmlspecialchars($row['author']); ?> | <?php echo $row['created_at']; ?></p>
<?php if($row['image']){ ?>
<img src="uploads/<?php echo $row['image']; ?>" width="250">
<?php } ?>
<p><?php echo nl2br(htmlspecialchars(substr($row['content'],0,200))); ?>...</p>
<a href="blog_details.php?id=<?php echo $row['id']; ?>">Read More</a>
</div>

<?php } ?>

<?php include("includes/footer.php"); ?>

