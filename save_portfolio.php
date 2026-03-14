<?php

include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$user_id = $_SESSION['user_id'];

$title = htmlspecialchars(trim($_POST['title']));
$description = htmlspecialchars(trim($_POST['description']));

$max_size = 2 * 1024 * 1024; // 2MB limit

/* check if file exists */
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$size = $_FILES['image']['size'];

$allowed = ["jpg","jpeg","png","gif"];

$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

/* check extension */
if(!in_array($ext,$allowed)){
die("Invalid file type.");
}

/* check size */
if($size > $max_size){
die("File too large.");
}

/* create safe file name */
$new_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/","",$image);

/* move file */
if(move_uploaded_file($tmp,"uploads/".$new_name)){

$stmt = $conn->prepare(
"INSERT INTO portfolios (user_id,title,description,image)
VALUES (?,?,?,?)"
);

$stmt->bind_param("isss",$user_id,$title,$description,$new_name);

$stmt->execute();
$stmt->close();

header("Location: portfolio.php");
exit();

}else{

die("Upload failed.");

}

}else{

die("No image uploaded.");

}

}
?>