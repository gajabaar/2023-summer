# WEEKLY REPORT SUMMARY

This file contains the weekly summary of throughout the four weeks long developement phase of the `Gwitter` web application. 
\
&nbsp; 
## WEEK ONE
***
The first week focused on learning about `SQLite` Essentials and designing the database.
<details>
<summary> Click here to view Week One Report </summary>

### 1. SQLite Introduction
`SQLite` is a free, cross-platform database management system. It is popular for its efficiency and ability to interface with many different programming languages.
\
&nbsp;
### 2. SQLite Installation
Follow the following steps to install SQLite on your ubuntu pc.
- First upgrade your package list :
    ```properties
        sudo apt update
    ```
- Install `SQLite` :
    ```properties
        sudo apt install sqlite3
    ```
- Version can be verified by :
    ```properties
        sqlite3 --version
    ```
&nbsp;
### 3. SQLite Database Creation
```properties
    sqlite3 <database_name>.db
```
This will create a new database named <database_name>. If the file <database_name>.db already exists, `SQLite` will open a connection to it. If it does not exist, `SQLite` will create it.
\
&nbsp;
### 4. SQLite Table Creation
Tables are used to organize the `SQLite` databases and table stores the information. The table consists of rows and columns. The `SQLite` is `case-sensetive`, where the `SQLite` commands are uppercase and the user information are generally lowercase. And each command in `SQLite` must end with a `semicolon (;)`.  
To create a new table in SQLite we can make use of `CREATE TABLE` statement.
```sql
    CREATE TABLE [IF NOT EXISTS] [schema_name].table_name (
	    column_1 data_type PRIMARY KEY,
   	    column_2 data_type NOT NULL,
	    column_3 data_type DEFAULT 0,
	    table_constraints
    ) [WITHOUT ROWID];
```
What does the syntax represent:
- We specify the name of table after `CREATE TABLE` keywords. One this to keep remember is that table name can't be `sqlite_` as it is reserved for internal `SQLite` use.
- `IF NOT EXISTS` option is used to create a new table is it doesn't exist. If we attempt to create a new table that already exists without using `IF NOT EXISTS` option this will cause error.
- `schema_name` is used to specify which schema the database belongs to.
- Then we specify the column list in the table. Each column has a `column_name` ex. column_1, `data_type`, and the `column_constraints`.
- `SQLite` supports `PRIMARY KEY`, `UNIQUE`, `NOT NULL`, and `CHECK` column constraints.
- We can also specify the table constraints like `PRIMARY KEY`, `FOREIGN KEY`,`UNIQUE`, and `CHECK` constraints.
- The use of `WITHOUT ROWID` is optional. By default, a row in a table has an implicit column, which is referred to as the `rowid`, `oid` or `_rowid_` column. The `rowid` column stores a 64-bit signed integer key that uniquely identifies the row inside the table. If we don’t want `SQLite` creates the `rowid` column, we specify the `WITHOUT ROWID` option. A table that contains the `rowid` column is known as a `rowid` table.
- Table constraints and column constraints can be explanied as if primary key consists of one column then use column constraints but is primary key consists of multiple column then table constraints can be used.
Example:
```sql
    CREATE TABLE groups (
        group_id INTEGER PRIMARY KEY,
        name TEXT NOT NULL
    );
```
The `contact_id` is the primary key of the contacts table. Because the `primary key` consists of one column, you can use the column constraint.
Example:
```sql
    CREATE TABLE contact_groups(
        contact_id INTEGER,
        group_id INTEGER,
        PRIMARY KEY (contact_id, group_id),
        FOREIGN KEY (contact_id) 
            REFERENCES contacts (contact_id) 
                ON DELETE CASCADE 
                ON UPDATE NO ACTION,
        FOREIGN KEY (group_id) 
            REFERENCES groups (group_id) 
                ON DELETE CASCADE 
                ON UPDATE NO ACTION
    );
```
The `contact_groups` table has a `primary key` that consists of two columns: `contact_id` and `group_id`. In addition, the `contact_id` and `group_id` are the `foreign keys`. Therefore, we use `FOREIGN KEY` constraint to define a `foreign key` for each column.
\
&nbsp;
### 5. Data Insertion into SQLite Table
To insert data into a table, we use the `INSERT` statement. `SQLite` provides various forms of the `INSERT` statements that allow you to insert a single row, multiple rows, and default values into a table.
- Example 1: Insert single row into the table.
    ```sql
        INSERT INTO table (column1,column2 ,..) VALUES( value1,	value2 ,...);
    ``` 
    - Specify the name of the table to which you want to insert data after the `INSERT INTO` keywords.
    - Add a comma-separated list of columns after the table name. The column list is optional. However, it is a good practice to include the column list after the table name.
    - Add a comma-separated list of values after the VALUES keyword. If you omit the column list, you have to specify values for all columns in the value list. The number of values in the value list must be the same as the number of columns in the column list.
- Example 2: Inserting multiple rows into a table
    ```sql
        INSERT INTO table1 (column1,column2 ,..)
        VALUES 
           (value1,value2 ,...),
           (value1,value2 ,...),
            ...
           (value1,value2 ,...);
    ``` 
    Each value list following the VALUES clause is a row that will be inserted into the table.
\
&nbsp;
### 6. SELECT Data from Tables in SQLite
The `SELECT` statement is one of the most commonly used statements in SQL. The `SQLite SELECT` statement provides all features of the `SELECT` statement in SQL standard. We often use the `SELECT` statement to query data from one or more table. The syntax of the `SELECT` statement is as follows:
```sql
    SELECT DISTINCT column_list
    FROM table_list
        JOIN table ON join_condition
    WHERE row_filter
    ORDER BY column
    LIMIT count OFFSET offset
    GROUP BY column
    HAVING group_filter;
```
Breaking down the above `SELECT` statement into multiple parts:
- Use `ORDER BY` clause to sort the result set
- Use `DISTINCT` clause to query unique rows in a table
- Use `WHERE` clause to filter rows in the result set
- Use `LIMIT OFFSET` clauses to constrain the number of rows returned
- Use `INNER JOIN` or `LEFT JOIN` to query data from multiple tables using join.
- Use `GROUP BY` to get the group rows into groups and apply aggregate function for each group.
- Use `HAVING` clause to filter groups
Example:
- ```sql
    SELECT column_list
    FROM table;
  ```
  Even though the `SELECT` clause appears before the `FROM` clause, `SQLite` evaluates the `FROM` clause first and then the `SELECT` clause, therefore:
    - First, specify the table where you want to get data from in the `FROM` clause. Notice that you can have more than one table in the `FROM` clause. We will discuss it in the subsequent tutorial.
    - Second, specify a column or a list of comma-separated columns in the `SELECT` clause.
- ```sql
    SELECT * FROM tracks;
  ```
  For a table with many columns, the query would be so long that time-consuming to type. To avoid this, you can use the asterisk (*), which is the shorthand for all columns of the table.
\
&nbsp;
### 7. Altering Tables in SQLite  
`SQLite` allows you to change your table using the `ALTER TABLE` command. This means that you can create new rows and columns, or modify existing rows and columns, and also chage the name of the table.
- Using `SQLite ALTER TABLE` to rename a table  
  To rename a table, you use the following `ALTER TABLE RENAME TO` statement:  
  ```sql
    ALTER TABLE existing_table
    RENAME TO new_table;
  ```
- Using `SQLite ALTER TABLE` to add a new column to a table  
    We can use the `SQLite ALTER TABLE` statement to add a new column to an existing table. In this scenario, `SQLite` appends the new column at the end of the existing column list.  
    The following illustrates the syntax of `ALTER TABLE ADD COLUMN` statement:
    ```sql
        ALTER TABLE table_name
        ADD COLUMN column_definition;
    ```
    Some restrictions:
    - The new column cannot have a UNIQUE or PRIMARY KEY constraint.
    - If the new column has a NOT NULL constraint, you must specify a default value for the column other than a NULL value.
    - The new column cannot have a default of CURRENT_TIMESTAMP, CURRENT_DATE, and CURRENT_TIME, or an expression.
    - If the new column is a foreign key and the foreign key constraint check is enabled, the new column must accept a default value NULL.
- Using `SQLite ALTER TABLE` to rename a column  
    The following shows the syntax of the ALTER TABLE RENAME COLUMN statement:
    ```sql
        ALTER TABLE table_name
        RENAME COLUMN current_name TO new_name;
    ```
\
&nbsp;
### 8. Deleting From Tables in SQLite 
Sometimes we need to remove rows from a table. In this case, we use `SQLite DELETE` statement. The `SQLite DELETE` statement allows you to delete one row, multiple rows, and all rows in a table.  
The syntax of the SQLite DELETE statement is as follows:
```sql
    DELETE FROM table
    WHERE search_condition;
```
- First, specify the name of the table which you want to remove rows after the `DELETE FROM` keywords.
- Second, add a search condition in the `WHERE` clause to identify the rows to remove. The `WHERE` clause is an optional part of the `DELETE` statement. If we omit the `WHERE` clause, the `DELETE` statement will delete all rows in the table.  

`SQLite` also provides an extension to the `DELETE` statement by adding `ORDER BY` and `LIMIT` clauses. If we compile `SQLite` with the `SQLITE_ENABLE_UPDATE_DELETE_LIMIT` compile-time option, we can use the `ORDER BY` and `LIMIT` clause in the `DELETE` statement like the following form:
```sql
    DELETE FROM table
    WHERE search_condition
    ORDER BY criteria
    LIMIT row_count OFFSET offset;
```
The `ORDER BY` clause sorts the rows filtered by the preceding search_condition in the `WHERE` clause and the `LIMIT` clause specifies the number of rows that to be deleted.
\
&nbsp;
### 8. Joining Tables in SQLite 
To join the tables in `SQLite` we can use an `INNER JOIN`, `LEFT JOIN`, or `CROSS JOIN` clause. Each join clause determines how `SQLite` uses data from one table to match with rows in another table.  
Note that `SQLite` doesn’t directly support the `RIGHT JOIN` and `FULL OUTER JOIN`.
- `SQLite INNER JOIN`
    ```sql
        SELECT 
            Title,
            Name
        FROM 
            albums
        INNER JOIN artists 
            ON artists.ArtistId = albums.ArtistId;
    ```
    In this example, the `INNER JOIN` clause matches each row from the albums table with every row from the artists table based on the join condition `(artists.ArtistId = albums.ArtistId)` specified after the `ON` keyword.

    If the join condition evaluates to true (or 1), the columns of rows from both albums and artists tables are included in the result set.
- `SQLite LEFT JOIN`
    ```sql
        SELECT
            Name, 
            Title
        FROM
            artists
        LEFT JOIN albums ON
            artists.ArtistId = albums.ArtistId
        ORDER BY Name;
    ```
    The `LEFT JOIN` clause selects data starting from the left table (artists) and matching rows in the right table (albums) based on the join condition `(artists.ArtistId = albums.ArtistId)` .

    The left join returns all rows from the artists table (or left table) and the matching rows from the albums table (or right table).

    If a row from the left table doesn’t have a matching row in the right table, SQLite includes columns of the rows in the left table and NULL for the columns of the right table.

- `SQLite CROSS JOIN`
    The `CROSS JOIN` clause creates a Cartesian product of rows from the joined tables.

    Unlike the `INNER JOIN` and `LEFT JOIN` clauses, a `CROSS JOIN` doesn’t have a join condition. Here is the basic syntax of the `CROSS JOIN` clause:
    ```sql
        SELECT
            select_list
        FROM table1
        CROSS JOIN table2;
    ```
    The `CROSS JOIN` combines every row from the first table (table1) with every row from the second table (table2) to form the result set.

    If the first table has N rows, the second table has M rows, the final result will have NxM rows.

    A practical example of the `CROSS JOIN` clause is to combine two sets of data for forming an initial data set for further processing. For example, you have a list of products and months, and you want to make a plan when you can sell which products.

</details>

\
&nbsp; 
## WEEK Two
***
...
<details>
<summary> Click here to view Week Two Report </summary>
Comming Soon

</details>

\
&nbsp; 
## WEEK Three
***
...
<details>
<summary> Click here to view Week Three Report </summary>
Comming Soon

</details>


&nbsp; 
## WEEK Four
***
...
<details>
<summary> Click here to view Week Four Report </summary>
Comming Soon

</details>