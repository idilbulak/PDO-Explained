<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');

$userIdToUpdate = 1;
$newEmail = "updated_email@example.com";

$stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
$stmt->bindParam(':id', $userIdToUpdate, PDO::PARAM_INT);
$stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
$stmt->execute();

echo "User with ID $userIdToUpdate has been updated.";
?>
