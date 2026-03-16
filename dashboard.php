<?php
include("config/database.php");
include("includes/security.php");
include("includes/csrf.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT name,email,role FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch user projects
$stmt = $conn->prepare("SELECT * FROM projects WHERE user_id=? ORDER BY id DESC");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$projects_result = $stmt->get_result();
$projects = [];
while($row = $projects_result->fetch_assoc()){
    $projects[] = $row;
}
$stmt->close();

?>

<?php include("includes/header.php"); ?>

<h2>Dashboard</h2>

<p>Welcome, <?php echo e($user['name']); ?> (<?php echo e($user['role']); ?>)</p>

<h3>Your Projects</h3>

<?php if(count($projects) == 0){ ?>
<p>You have not posted any projects yet.</p>
<?php } else { ?>
<ul>
<?php foreach($projects as $proj){ ?>
<li>
<a href="project_details.php?id=<?php echo $proj['id']; ?>"><?php echo e($proj['title']); ?></a>
</li>
<?php } ?>
</ul>
<?php } ?>

<p><a href="post_projects.php">Post a New Project</a></p>

<?php include("includes/footer.php"); ?>