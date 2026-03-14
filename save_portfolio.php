<?php

include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$user_id = $_SESSION['user_id'];

$title = htmlspecialchars(trim($_POST['title']));
$description = htmlspecialchars(trim($_POST['description']));

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$allowed = ["jpg","jpeg","png","gif"];

$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
die("Invalid image format");
}

$new_name = time()."_".$image;

move_uploaded_file($tmp,"uploads/".$new_name);

$stmt = $conn->prepare(
"INSERT INTO portfolios (user_id,title,description,image)
VALUES (?,?,?,?)"
);

$stmt->bind_param("isss",$user_id,$title,$description,$new_name);

$stmt->execute();
$stmt->close();

header("Location: portfolio.php");

}
?>

