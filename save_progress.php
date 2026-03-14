<?php

include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$project_id = intval($_POST['project_id']);
$stage = htmlspecialchars(trim($_POST['stage']));
$progress = intval($_POST['progress']);
$description = htmlspecialchars(trim($_POST['description']));

$photo_name = "";

if(!empty($_FILES['photo']['name'])){

$image = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];

$allowed = ["jpg","jpeg","png","gif"];
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
die("Invalid image format");
}

$photo_name = time()."_".$image;

move_uploaded_file($tmp,"uploads/".$photo_name);

}

$stmt = $conn->prepare(
"INSERT INTO project_progress 
(project_id,stage,progress,description,photo)
VALUES (?,?,?,?,?)"
);
 
$max_size = 2 * 1024 * 1024; // 2MB

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$size = $_FILES['image']['size'];

$allowed = ["jpg","jpeg","png","gif"];

$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
die("Invalid file type.");
}

if($size > $max_size){
die("File too large.");
}

$new_name = time()."_".$image;

move_uploaded_file($tmp,"uploads/".$new_name);



$stmt->bind_param("isiss",$project_id,$stage,$progress,$description,$photo_name);

$stmt->execute();
$stmt->close();

header("Location: project_progress.php?project_id=".$project_id);

}
?>
