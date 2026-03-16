<?php
include("config/database.php");
include("includes/security.php");

$result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
include("includes/header.php");
?>

<h2>Blog Posts</h2>
<?php while($row = $result->fetch_assoc()){ ?>
<div>
<h3><a href="blog_details.php?id=<?php echo $row['id']; ?>"><?php echo e($row['title']); ?></a></h3>
<p><?php echo e(substr($row['content'],0,150)); ?>...</p>
</div>
<?php } ?>

<?php include("includes/footer.php"); ?>