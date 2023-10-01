# PDO Query Patterns and Explanations

This document provides a quick reference for commonly used SQL query patterns in PDO. For a comprehensive understanding and more patterns, refer to the [Official PDO Documentation](https://www.php.net/manual/en/book.pdo.php).

## 1. SELECT

**Pattern:** 
```sql
SELECT column1, column2, ... FROM table_name WHERE condition;
```

**Explanation:**
Used to retrieve data from one or more tables. You can specify conditions using the WHERE clause.

## 2. INSERT INTO
**Pattern:** 

```sql
INSERT INTO table_name (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);
```

**Explanation:**
Used to insert new rows into a table.

## 3. UPDATE
**Pattern:** 

```sql
UPDATE table_name SET column1 = value1, column2 = value2, ... WHERE condition;
```

**Explanation:**
Used to modify existing records in a table. The WHERE clause specifies which record(s) should be updated.

## 4. DELETE
**Pattern:** 

```sql
DELETE FROM table_name WHERE condition;
```

**Explanation:**
Used to delete records from a table. The WHERE clause specifies which record(s) should be deleted.

## 5. JOIN Operations
**Pattern:**  (INNER JOIN):

```sql
SELECT column_names FROM table1 INNER JOIN table2 ON table1.column_name = table2.column_name;
```

**Explanation:**
Used to retrieve rows that have matching values in both tables.
