<?php
include("config/database.php");
include("includes/header.php");
include("includes/currency.php");

if(!isset($_GET['id'])){
    die("No project specified.");
}

$project_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM projects WHERE id=?");
$stmt->bind_param("i",$project_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows != 1){
    die("Project not found.");
}

$row = $result->fetch_assoc();

$user_country = $_SESSION['country'] ?? 'USA';

function displayBudget($budgetUSD, $country){
    $converted = convertCurrency($budgetUSD, $country);
    return $converted . " " . getCurrencySymbol($country);
}
?>

<h2><?php echo htmlspecialchars($row['title']); ?></h2>

<p><?php echo htmlspecialchars($row['description']); ?></p>
<p><b>Location:</b> <?php echo htmlspecialchars($row['location']); ?></p>
<p><b>Budget:</b> <?php echo displayBudget($row['budget'],$user_country); ?></p>

<?php if(!empty($row['file_path'])){ ?>
<p><a href="<?php echo e($row['file_path']); ?>" target="_blank">Download File</a></p>
<?php } ?>

<?php include("includes/footer.php"); ?>