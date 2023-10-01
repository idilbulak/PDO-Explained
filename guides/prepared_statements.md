# Prepared Statements with PDO

Prepared statements, also known as parameterized queries, are a way to execute SQL statements safely. They ensure that an application can use external data without the risk of SQL injection attacks. By using prepared statements with PDO, the data sent to the database is automatically treated as a string, making it much more difficult for a malicious user to inject malicious SQL.

## What are prepared statements?

In a prepared statement, SQL code is defined once and then sent to the database. External data is then sent separately, which allows the database to distinguish between code and data, regardless of what the data content is. This approach dramatically reduces the risk of an SQL injection attack.

## Why are prepared statements crucial?

1. **Security**: They defend against SQL injection, which is a common web application vulnerability.
2. **Efficiency**: They can be more efficient if the same query is executed multiple times with different data.
3. **Usability**: By abstracting variable input, they often make queries more readable and easier to debug.

## Examples using prepared statements with PDO

### Basic Usage

```php
$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'user', 'password');
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->execute(['John Doe', 'john.doe@example.com']);
```

### Named placeholders

```php
$pdo = new PDO('mysql:host=localhost;dbname=mydb', 'user', 'password');
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
$stmt->execute(['name' => 'John Doe', 'email' => 'john.doe@example.com']);
```

### Conclusion

Using prepared statements with PDO not only offers enhanced security against SQL injection attacks but also provides an efficient way to execute queries. It's an essential practice for any developer working with databases in PHP.