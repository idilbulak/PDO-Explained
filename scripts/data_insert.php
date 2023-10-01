<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

$users = [
    ['John Doe', 'john@example.com', 'password123'],
    ['Jane Smith', 'jane@example.com', 'securepass'],
    // ...
];

foreach ($users as $user) {
    $stmt->execute($user);
}
?>
