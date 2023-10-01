# Advanced Techniques with PDO

PDO (PHP Data Objects) offers a wide array of advanced functionalities that can optimize your database interactions and provide a more secure, efficient, and modular way to handle data. This guide explores some of these advanced features.

## Table of Contents

1. [Transactions](#transactions)
2. [Advanced Querying Techniques](#advanced-querying-techniques)
3. [Working with Multiple Databases](#working-with-multiple-databases)
4. [PDO and Stored Procedures](#pdo-and-stored-procedures)

## Transactions

Transactions ensure that a series of operations are completed successfully before the data is committed to the database. If an error occurs during one of the operations, none of the operations in the transaction are committed.

```php
try {
    $pdo->beginTransaction();

    $pdo->exec("INSERT INTO users (name, email) VALUES ('John', 'john@example.com')");
    $pdo->exec("UPDATE account SET balance=balance-100 WHERE user_id=1");

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollback();
    echo "Transaction failed: " . $e->getMessage();
}
```

beginTransaction():
This function starts a database transaction.
When using transactions, changes to the database won't be applied immediately, but rather they'll be held in a temporary state until you either confirm (commit) or discard (rollback) them.
Using transactions is useful when you have multiple queries that should either all succeed or all fail as a group. This ensures data integrity.

exec():
The exec() function is used to execute an SQL statement directly and returns the number of rows affected by the query.
It's typically used for SQL queries that do not return rows (e.g., INSERT, UPDATE, DELETE).
In the given code, two exec() statements are used: one to insert a new user into the users table and another to update the account table.

commit():
Once all the database operations within the transaction are successful, the commit() function is used to save all the changes to the database permanently.
After commit(), the transaction is complete, and the changes are irreversible.

rollback():
If an error occurs within the transaction (like a query failure or an exception being thrown), the rollback() function is used to discard all the changes made during that transaction.
This is like an "undo" action. The database is returned to the state it was in before the transaction started.

## Advanced Querying Techniques

### Fetch Styles

PDO provides different fetch styles to retrieve data:

```php
$stmt = $pdo->query("SELECT name, email FROM users");
while ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo $user->name . ' - ' . $user->email;
}
```

PDO::FETCH_ASSOC: Returns the results as associative arrays only.
PDO::FETCH_NUM: Returns the results as indexed arrays only.
PDO::FETCH_BOTH: Returns the results as both associative and indexed arrays. This is the default behavior.
PDO::FETCH_OBJ: Returns the results as an anonymous object.
PDO::FETCH_LAZY: Returns an object that has properties allowing for both indexed and associative array access, as well as object property access.
PDO::FETCH_BOUND: Binds columns to variables using PDOStatement::bindColumn().
PDO::FETCH_CLASS: Returns a new instance of the specified class, and sets the column values as the properties of this class.
PDO::FETCH_INTO: Sets the column values into an existing object instance.
PDO::FETCH_FUNC: Returns the result of calling the specified function with the first column value.
PDO::FETCH_GROUP: Groups results by the values of the first column, using that value as the associated key.
PDO::FETCH_UNIQUE: Returns a result set that will have only one row for each value of the first column.
PDO::FETCH_KEY_PAIR: Used for two-column result sets. The first column is the key, and the second column is the value.
PDO::FETCH_COLUMN: Returns the desired 0-indexed column.
PDO::FETCH_SERIALIZE: Returns columns as an instance of the specified class, associated with PHP serialization.

## Working with Multiple Databases

It's possible to maintain connections to multiple databases using separate PDO instances:

```php
$db1 = new PDO($dsn1, $user1, $password1);
$db2 = new PDO($dsn2, $user2, $password2);
```

## PDO and Stored Procedures

PDO can interact seamlessly with stored procedures:

```php
$stmt = $pdo->prepare("CALL sp_get_users_by_name(:name)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->execute();

while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $user['name'] . ' - ' . $user['email'];
}
```

prepare():
This method prepares an SQL statement for execution. It returns a statement object ($stmt in this case).
In the provided code, the SQL statement is a call to a stored procedure named sp_get_users_by_name. This stored procedure presumably retrieves users based on a given name. The :name is a placeholder that will later be bound to a real value.

## Conclusion

The advanced features of PDO empower developers to manage database interactions with greater efficiency and flexibility. By mastering these techniques, you can ensure robust and scalable database operations in your PHP applications.
