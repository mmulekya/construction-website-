<?php
require_once "includes/security.php";
require_login();
include("config/database.php");
include("includes/header.php");
?>

<h2>Search BuildSmart</h2>

<form method="GET">
<input type="text" name="q" placeholder="Search projects, constructors, blogs..." required>
<button type="submit">Search</button>
</form>

<hr>

<?php

if(isset($_GET['q'])){

$search = "%".sanitize($_GET['q'])."%";

/* Search Projects */

echo "<h3>Projects</h3>";

$stmt = $conn->prepare("SELECT title,location FROM projects WHERE title LIKE ?");
$stmt->bind_param("s",$search);
$stmt->execute();
$res = $stmt->get_result();

while($row=$res->fetch_assoc()){
echo "<p>🏗 ".e($row['title'])." - ".e($row['location'])."</p>";
}

/* Search Constructors */

echo "<h3>Constructors</h3>";

$stmt = $conn->prepare("SELECT name,location FROM constructors WHERE name LIKE ?");
$stmt->bind_param("s",$search);
$stmt->execute();
$res = $stmt->get_result();

while($row=$res->fetch_assoc()){
echo "<p>👷 ".e($row['name'])." - ".e($row['location'])."</p>";
}

/* Search Blogs */

echo "<h3>Blog Posts</h3>";

$stmt = $conn->prepare("SELECT title FROM blogs WHERE title LIKE ?");
$stmt->bind_param("s",$search);
$stmt->execute();
$res = $stmt->get_result();

while($row=$res->fetch_assoc()){
echo "<p>📰 ".e($row['title'])."</p>";
}

/* Search Portfolio */

echo "<h3>Portfolio</h3>";

$stmt = $conn->prepare("SELECT title FROM portfolio WHERE title LIKE ?");
$stmt->bind_param("s",$search);
$stmt->execute();
$res = $stmt->get_result();

while($row=$res->fetch_assoc()){
echo "<p>🎨 ".e($row['title'])."</p>";
}

}

include("includes/footer.php");
?>