## Join Operations with PDO

In this example, we will demonstrate how to perform `JOIN` operations using PDO to combine rows from two or more tables based on a related column.

### Database Tables

Consider we have two tables, `users` and `orders`:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Joining Tables using PDO

Now, let's join the users and orders tables to list the username along with the product name and amount they ordered:

```php
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');

// Using INNER JOIN to combine the tables
$stmt = $pdo->query("
    SELECT users.username, orders.product_name, orders.amount 
    FROM users 
    INNER JOIN orders ON users.id = orders.user_id
");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Username: " . $row['username'] . " - Product: " . $row['product_name'] . " - Amount: " . $row['amount'] . "<br>";
}
```

This script will list the orders for each user from the users table.

Additionally, you can also explore other JOIN types like LEFT JOIN, RIGHT JOIN, or FULL JOIN, depending on which rows you want to retrieve. The choice of JOIN type should be made based on the data needs.

### Different Types of SQL JOINs

When you're working with multiple tables in a relational database, JOIN operations are crucial to bring together data that sits in different tables. Here's a brief overview of the primary JOIN types:

1. INNER JOIN (or simply JOIN):
This returns rows when there is at least one match in both tables. If a record in the first table does not have a corresponding match in the second table, it will not appear in the results.
2. LEFT JOIN (or LEFT OUTER JOIN):
This returns all rows from the left table, and the matching rows from the right table. If there's no match for a particular row in the left table, the result will contain NULL for columns from the right table.
3. RIGHT JOIN (or RIGHT OUTER JOIN):
It's the opposite of a LEFT JOIN. This type of JOIN returns all rows from the right table, and the matching rows from the left table. If there's no match for a particular row in the right table, the result will contain NULL for columns from the left table.
4. FULL JOIN (or FULL OUTER JOIN):
This returns all rows when there's a match in one of the tables. It means if there's a row in the left table that doesn't have a matching row in the right table, the results will contain a row with NULL for columns from the right table, and vice versa.