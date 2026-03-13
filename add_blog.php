<?php
include("includes/header.php");
include("includes/auth.php");
include("config/database.php");
?>

<h2>Add New Blog Post</h2>

<form action="save_blog.php" method="POST" enctype="multipart/form-data">
<label>Title</label>
<input type="text" name="title" required>

<label>Content</label>
<textarea name="content" rows="10" required></textarea>

<label>Featured Image</label>
<input type="file" name="image">

<button type="submit">Publish Post</button>
</form>

<?php include("includes/footer.php"); ?>
