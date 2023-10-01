<?php
$dbhost = 'localhost';
$dbuser = 'username';
$dbpass = 'password';
$dbname = 'myDatabase';
$backup_file = 'backup/' . $dbname . '_' . date("Y-m-d-H-i-s") . '.sql';

$command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $backup_file";
system($command);

echo "Backup created successfully!";
?>
