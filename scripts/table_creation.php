<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');
$sql = "
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
$pdo->exec($sql);
?>
