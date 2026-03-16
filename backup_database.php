<?php
include("config/database.php");
include("includes/security.php");
check_login();
check_admin(); // only admin can access

if($_SERVER["REQUEST_METHOD"]==="POST"){
    // Backup database
    $backup_file = 'backup_'.date('Ymd_His').'.sql';
    exec("mysqldump -u ".DB_USER." -p".DB_PASS." ".DB_NAME." > backups/$backup_file");
    echo "<p>Database backup created: $backup_file</p>";
}

include("includes/header.php"); 
?>
<h2>Backup Database</h2>
<form method="POST">
<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
<button type="submit">Create Backup</button>
</form>
<?php include("includes/footer.php"); ?>