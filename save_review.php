<?php

include("config/database.php");
include("includes/auth.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$user_id = $_SESSION['user_id'];
$constructor_id = intval($_POST['constructor_id']);
$rating = intval($_POST['rating']);
$review = htmlspecialchars(trim($_POST['review']));

$stmt = $conn->prepare(
"INSERT INTO reviews (user_id,constructor_id,rating,review)
VALUES (?,?,?,?)"
);

$stmt->bind_param("iiis",$user_id,$constructor_id,$rating,$review);

$stmt->execute();
$stmt->close();

header("Location: profile.php?id=".$constructor_id);

}
?>