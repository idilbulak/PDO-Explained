# PDO Basic Usage

The PHP Data Objects (PDO) extension offers a consistent and lightweight interface for accessing databases in PHP. This guide will walk you through the basics of using PDO to connect to a database and execute simple queries.

## Establishing a Connection

To interact with a database using PDO, you first need to establish a connection. Here's how you can connect to a MySQL database:

```php
<?php
$host = '127.0.0.1';
$db   = 'my_database';
$user = 'my_user';
$pass = 'my_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```

## PDO Object Methods:

1. beginTransaction(): Starts a new transaction.
2. commit(): Commits the current transaction.
3. errorCode(): Fetches the error code of the last operation.
4. errorInfo(): Fetches extended error information of the last operation.
5. exec(): Executes an SQL statement and returns the number of affected rows.
6. getAttribute(): Retrieves a specific attribute value.
7. inTransaction(): Checks if there's an active transaction, returns true if inside a transaction.
8. lastInsertId(): Returns the ID of the last inserted row.
9. prepare(): Prepares a statement for execution.
10. query(): Executes an SQL statement, returning a result set as a PDOStatement object.
11. quote(): Quotes a string (does not provide protection against SQL injection, just quotes the string).
12. rollBack(): Rolls back the current transaction.
13. setAttribute(): Sets a specific attribute to the provided value.

## PDOStatement Methods

1. bindValue(): Binds a value to a named or question mark placeholder in the SQL statement. It allows you to specify both the value and its data type.
2. bindParam(): Binds a variable to a named or question mark placeholder in the SQL statement. This means when the variable changes before the statement's execution, the placeholder will use the updated value.
3. closeCursor(): Frees up the connection to the server so that other SQL statements may be issued.
4. columnCount(): Returns the number of columns in the result set.
5. debugDumpParams(): Dumps the SQL statement with embedded input parameters. Useful for debugging.
6. errorCode(): Fetches the SQLSTATE associated with the last operation on the statement handle.
7. errorInfo(): Fetches extended error information for the last operation performed.
8. execute(): Executes a prepared statement. If an array of input values is passed, it will be used as input parameters.
9. fetch(): Fetches the next row from the result set.
10. fetchAll(): Fetches all rows from the result set.
11. fetchColumn(): Returns a single column from the next row of a result set.
12. fetchObject(): Fetches the next row and returns it as an object.
13. getAttribute(): Retrieves a statement attribute.
14. getColumnMeta(): Fetches metadata for a single column in a result set.
15. nextRowset(): Advances to the next rowset in a multi-rowset statement.
16. rowCount(): Returns the number of rows affected by the last SQL statement.
17. setAttribute(): Sets an attribute of the statement handle.
18. setFetchMode(): Sets the fetch mode to use while iterating this statement.

## Fetching Data
To retrieve data from the database, you can use the query method. Here's an example:

```php
$stmt = $pdo->query('SELECT name FROM users');
while ($row = $stmt->fetch()) {
    echo $row['name'] . '<br>';
}
```

## Inserting Data
You can also easily insert data into the database:

```php
$sql = "INSERT INTO users (name, email) VALUES (?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute(['John Doe', 'john@example.com']);
```

## Updating and Deleting Data

### Updating:

```php
$sql = "UPDATE users SET email=? WHERE name=?";
$stmt= $pdo->prepare($sql);
$stmt->execute(['newmail@example.com', 'John Doe']);
```

### Deleting:

```php
$sql = "DELETE FROM users WHERE name=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(['John Doe']);
```

## Closing the Connection
Although the connection is automatically closed at the end of the script execution, it's a good practice to close it explicitly:

```php
$pdo = null;
```

## Conclusion

With these basic operations, you have a solid foundation to interact with your database using PDO. As you delve deeper into PDO's capabilities, you'll discover its vast range of functionalities that cater to both beginners and advanced users.