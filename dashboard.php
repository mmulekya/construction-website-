<?php

include("includes/header.php");
include("includes/auth.php");
require_once "includes/security.php";
require_login();

?>

<h2>Welcome <?php echo htmlspecialchars($_SESSION['name']); ?></h2>

<ul>

<li><a href="profile.php">My Profile</a></li>

<li><a href="projects.php">Browse Projects</a></li>

<li><a href="post_projects.php">Post Project</a></li>

<li><a href="constructors.php">Find Constructors</a></li>

<li><a href="chat.php">Messages</a></li>

<li><a href="blog.php">Knowledge Hub</a></li>

<li><a href="ai_cost_calculator.php">AI Cost Calculator</a></li>

</ul>

<?php include("includes/footer.php"); ?