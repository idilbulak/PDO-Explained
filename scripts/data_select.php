<?php
$pdo = new PDO('mysql:host=localhost;dbname=myDatabase', 'username', 'password');

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id'] . ' - ' . $row['name'] . ' - ' . $row['email'] . '<br>';
}
?>
