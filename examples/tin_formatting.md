## Formatting Tax Identification Number (TIN) with PDO

In this example, we will walk through formatting a TIN stored in a database. Let's assume the TINs are stored as simple strings of numbers, and you want to format them to have dashes ("-") for better readability.

### Database Table

Assume we have a `businesses` table in our database:

```sql
CREATE TABLE businesses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    tin VARCHAR(15) NOT NULL
);
```

The TIN format stored might be 1234567890123 and you want to display it as 123-456-789-0123.

1. Displaying Formatted TINs

To retrieve businesses and display their formatted TINs:

```php
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
$stmt = $pdo->query("SELECT * FROM businesses");

while ($business = $stmt->fetch()) {
    $formattedTIN = preg_replace("/^(\d{3})(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3-$4", $business['tin']);
    echo $business['name'] . ' - ' . $formattedTIN . '<br>';
}
```

This uses a regular expression to format the TIN into the desired pattern. Adjust the regular expression if your format requirements differ.

2. Updating TINs in the Database

First, let's define a function to format the TIN:

```php
function formatTIN($tin) {
    // Example: Convert to the format XXX-XX-XXXX
    return preg_replace("/^(\d{3})(\d{2})(\d{4})$/", "$1-$2-$3", $tin);
}
```

With this function in place, you can update the TINs in the database:

```php
$stmt = $pdo->query('SELECT id, tin FROM users WHERE tin IS NOT NULL');

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $formattedTIN = formatTIN($row['tin']);
    
    $updateStmt = $pdo->prepare('UPDATE users SET tin = :formattedTIN WHERE id = :id');
    $updateStmt->bindParam(':formattedTIN', $formattedTIN, PDO::PARAM_STR);
    $updateStmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
    $updateStmt->execute();
}

echo "TIN formats have been updated!";
```

Note: This operation makes permanent changes to your database. It's highly recommended to backup your database before running such operations.


### Path to Follow

1. Determine the Requirements: First and foremost, clearly specify what the new TIN format should be. This includes which characters will be used, the length of the number, any special characters (if any), and other specifics.

2. Review the Current Database: Examine the database table containing the current TIN values and any other tables related to it. This helps in identifying which tables will be affected by this task.

3. Backup: Always take a backup of your database before making any changes. This is critical to revert to the previous state in case of errors or unforeseen issues.

4. Write the Conversion Script: Draft a script that will transform old TIN values to align with your new TIN format. This script will fetch the current TIN values and convert them to your newly defined format.

5. Test the Script: First, run this script on a test database and inspect the outcomes. Ensure everything proceeds as expected.

6. Execute on the Live Database: After deploying your script on the live database, verify that the TIN values in the database have been transformed accurately.

7. Application and Interface Updates: If your system showcases the TIN number to users or accepts it from them, adapt these interfaces to comply with your new TIN format.

8. Testing: After all modifications, perform extensive system tests. Confirm that all functions related to TIN (adding, updating, querying, etc.) are operating correctly.

9. Documentation: Document the changes you've made and the rationale behind them. This can be crucial for understanding the reason for the changes in the future, either by team members or even yourself.