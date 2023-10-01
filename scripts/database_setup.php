<?php
$dsn = 'mysql:host=localhost';
$user = 'root';
$password = 'pass';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->exec("CREATE DATABASE myDatabase");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
