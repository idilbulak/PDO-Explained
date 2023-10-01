<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');

$userIdToDelete = 1;

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->bindParam(':id', $userIdToDelete, PDO::PARAM_INT);
$stmt->execute();

echo "User with ID $userIdToDelete has been deleted.";
?>
