<?php
include("includes/security.php");
include("includes/header.php");
include("config/database.php");

$country = isset($_GET['country']) ? sanitize($_GET['country']) : "";

?>

<h2>Find Constructors</h2>

<form method="GET">

<select name="country">

<option value="">All Countries</option>

<option value="Kenya">Kenya</option>
<option value="Tanzania">Tanzania</option>
<option value="Uganda">Uganda</option>
<option value="Rwanda">Rwanda</option>
<option value="USA">USA</option>
<option value="UK">UK</option>
<option value="India">India</option>

</select>

<button type="submit">Search</button>

</form>

<?php

if($country != ""){

$stmt = $conn->prepare(
"SELECT id,name,country FROM users
WHERE role='constructor' AND country=?"
);

$stmt->bind_param("s",$country);

}else{

$stmt = $conn->prepare(
"SELECT id,name,country FROM users
WHERE role='constructor'"
);

}

$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){

?>

<div class="card">

<h3><?php echo htmlspecialchars($row['name']); ?></h3>

<p>Country: <?php echo htmlspecialchars($row['country']); ?></p>

<a href="profile.php?id=<?php echo $row['id']; ?>">
View Profile
</a>

</div>

<?php
}

$stmt->close();

include("includes/footer.php");
?>