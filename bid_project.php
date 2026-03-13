<?php
include("includes/header.php");
include("includes/auth.php");

$project_id = intval($_GET['id']);
?>

<h2>Submit Bid</h2>

<form action="save_bid.php" method="POST">

<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

<label>Bid Amount</label>
<input type="number" name="amount" required>

<label>Proposal</label>
<textarea name="proposal" required></textarea>

<button type="submit">Submit Bid</button>

</form>

<?php include("includes/footer.php"); ?>

