<?php
session_start();
include("config/database.php");

$title = $_POST['title'];
$content = $_POST['content'];
$author_id = $_SESSION['user_id'];

$image = $_FILES['image']['name'];
if($image != ""){
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
}

$sql = "INSERT INTO blog_posts (title, content, author_id, image)
VALUES ('$title', '$content', '$author_id', '$image')";

mysqli_query($conn,$sql);

header("Location: blog.php");
?>
