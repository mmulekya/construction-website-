<?php
include("config/database.php");
include("includes/header.php");
include("includes/currency.php");

$user_country = $_SESSION['country'] ?? 'USA';

function displayBudget($budgetUSD, $country){
    $converted = convertCurrency($budgetUSD, $country);
    return $converted . " " . getCurrencySymbol($country);
}

$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");

if(!$result){
    echo "<p>No projects found.</p>";
    exit();
}
?>

<h2>Available Construction Projects</h2>

<?php while($row = $result->fetch_assoc()){ ?>
<div class="card">
<h3><?php echo htmlspecialchars($row['title']); ?></h3>
<p><?php echo htmlspecialchars($row['description']); ?></p>
<p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>
<p><b>Budget:</b> <?php echo displayBudget($row['budget'],$user_country); ?></p>
<?php if(!empty($row['file_path'])){ ?>
<p><a href="<?php echo e($row['file_path']); ?>" target="_blank">Download File</a></p>
<?php } ?>
<a href="project_details.php?id=<?php echo $row['id']; ?>">View Details</a>
</div>
<?php } ?>

<?php include("includes/footer.php"); ?>