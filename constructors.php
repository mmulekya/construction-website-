<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

/* Get country filter from GET request */
$country = isset($_GET['country']) ? sanitize($_GET['country']) : "";

?>

<h2>Find Constructors</h2>

<!-- Country Filter Form -->
<form method="GET">
    <label>Filter by Country:</label>
    <select name="country">
        <option value="">All Countries</option>
        <option value="Kenya" <?php if($country=="Kenya") echo "selected"; ?>>Kenya</option>
        <option value="Tanzania" <?php if($country=="Tanzania") echo "selected"; ?>>Tanzania</option>
        <option value="Uganda" <?php if($country=="Uganda") echo "selected"; ?>>Uganda</option>
        <option value="Rwanda" <?php if($country=="Rwanda") echo "selected"; ?>>Rwanda</option>
        <option value="USA" <?php if($country=="USA") echo "selected"; ?>>United States</option>
        <option value="UK" <?php if($country=="UK") echo "selected"; ?>>United Kingdom</option>
        <option value="India" <?php if($country=="India") echo "selected"; ?>>India</option>
    </select>
    <button type="submit">Search</button>
</form>

<?php

/* Fetch constructors from database */
if($country != ""){
    $stmt = $conn->prepare(
        "SELECT id,name,country FROM users WHERE role='constructor' AND country=?"
    );
    $stmt->bind_param("s",$country);
} else {
    $stmt = $conn->prepare(
        "SELECT id,name,country FROM users WHERE role='constructor'"
    );
}

$stmt->execute();
$result = $stmt->get_result();

/* Display results */
while($row = $result->fetch_assoc()){
?>
<div class="card">
    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
    <p>Country: <?php echo htmlspecialchars($row['country']); ?></p>
    <a href="profile.php?id=<?php echo $row['id']; ?>">View Profile</a>
</div>
<?php
}
$stmt->close();

include("includes/footer.php");
?>