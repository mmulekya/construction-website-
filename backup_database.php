<?php
require_once "config/database.php";

// Database credentials
$db_host = DB_HOST; // from database.php
$db_user = DB_USER;
$db_pass = DB_PASS;
$db_name = DB_NAME;

// Backup directory (make sure it exists and is writable)
$backup_dir = __DIR__ . "/backups/";
if(!is_dir($backup_dir)){
    mkdir($backup_dir, 0755, true);
}

// Backup file name
$filename = "backup_" . date("Y-m-d_H-i-s") . ".sql";
$filepath = $backup_dir . $filename;

// Command to export MySQL database
$command = "mysqldump --host={$db_host} --user={$db_user} --password={$db_pass} {$db_name} > {$filepath}";

// Execute the command
system($command, $output);

if($output === 0){
    echo "Backup successful! File saved as: " . $filepath;
}else{
    echo "Backup failed!";
}

?>