# Error Handling with PDO

Errors are inevitable when working with databases. Whether it's an incorrect SQL statement, a connection issue, or runtime anomalies, knowing how to handle errors is crucial. PDO offers various mechanisms to manage and handle these exceptions gracefully.

## Understanding PDO's Error Handling Mechanisms

PDO provides several modes for handling errors:

1. **Silent Mode (`PDO::ERRMODE_SILENT`)**:
    - This is the default error mode.
    - PDO will simply set error codes for you to check using `errorCode()` and `errorInfo()` methods, but it won't stop script execution.

2. **Warning Mode (`PDO::ERRMODE_WARNING`)**:
    - In this mode, PDO will issue a standard PHP warning and continue executing the script. 
    - This can be useful during debugging phases.

3. **Exception Mode (`PDO::ERRMODE_EXCEPTION`)**:
    - Here, PDO will throw exceptions whenever an error occurs.
    - Exceptions can be caught and handled using try/catch blocks in PHP, allowing you to manage errors gracefully.

You can set your preferred error mode using the `setAttribute` method on a PDO instance.

```php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

## Different Error Modes and Their Usage
Using Silent Mode

```php
$pdo = new PDO($dsn, $user, $password);
$result = $pdo->query("SELECT * from non_existent_table");

if (!$result) {
    $error = $pdo->errorInfo();
    echo "Error: " . $error[2];
}
```

## Using Warning Mode

```php
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$result = $pdo->query("SELECT * from non_existent_table");
```

## Using Exception Mode

```php
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $result = $pdo->query("SELECT * from non_existent_table");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

In summary, understanding and correctly utilizing PDO's error handling mechanisms can help you build robust database-driven applications, ensuring that any issues are caught and dealt with appropriately.
