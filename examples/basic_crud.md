## Basic CRUD Operations with PDO

In this example, we'll walk through basic CRUD operations (Create, Read, Update, Delete) using PDO on a hypothetical "users" table.

### Database Table

Assume we have a `users` table in our database:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);
```

1. Create (Insert)
To insert a new user into the users table:

```php
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

$name = 'John Doe';
$email = 'johndoe@example.com';

$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);

$stmt->execute();
```

2. Read (Select)
To fetch all users from the users table:

```php
$stmt = $pdo->query("SELECT * FROM users");

while ($user = $stmt->fetch()) {
    echo $user['name'] . ' - ' . $user['email'] . '<br>';
}
```

3. Update
To update the email of a user:

```php
$stmt = $pdo->prepare("UPDATE users SET email = :email WHERE name = :name");

$newEmail = 'johnnew@example.com';

$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $newEmail);

$stmt->execute();
```

4. Delete
To delete a user:

```php
$stmt = $pdo->prepare("DELETE FROM users WHERE name = :name");
$stmt->bindParam(':name', $name);
$stmt->execute();
```

Remember, always ensure that you handle exceptions and potential errors when working with databases. These examples are basic demonstrations, and you'll want to incorporate best practices such as using prepared statements (as shown) to prevent SQL injection, checking for successful statement execution, handling exceptions, etc.