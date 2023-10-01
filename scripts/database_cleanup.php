<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');

$stmt = $pdo->prepare("DELETE FROM users");
$stmt->execute();

$stmtReset = $pdo->prepare("ALTER TABLE users AUTO_INCREMENT = 1");
$stmtReset->execute();

echo "Database cleaned up successfully!";
?>
