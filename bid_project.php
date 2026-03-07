<?php

session_start();
include("config/database.php");

$project_id = $_GET['project_id'];

?>

<h2>Submit Your Bid</h2>

<form action="save_bid.php" method="POST">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<input type="number" name="price" placeholder="Your Price" required><br><br>

<textarea name="proposal" placeholder="Write your proposal"></textarea><br><br>

<button type="submit">Submit Bid</button>

</form>