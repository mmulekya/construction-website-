$sql = "SELECT * FROM project_updates WHERE project_id='$project_id' ORDER BY created_at DESC";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
echo "<p>".$row['update_text']." <br><small>".$row['created_at']."</small></p>";
}