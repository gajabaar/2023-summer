# Database Desgining for Gwitter

We are going to design the database of Gwitter using **Sqlite3**.

## Installation of Sqlite3
I have PopOS installed in my laptop. This command works for any Debian based OS.
```
sudo apt install sqlite3
```

We have created 2 sql files:
1. schema.sql: We have the necessary tables that helps us to login, signup, comment, follow the users in this file.
2. populate.sql: We have the dummy data in this file. 

### Creating Database
```
sqlite3 gwitter.db
```

### To create and populate the database
```
.read schema.sql
```

### To import dummy file
```
.read populate.sql
```

### To quit
```
.quit
```