# Database Desgining for Gwitter

We are going to design the database of Gwittter using **Sqlite3**.

## Installation of Sqlite3
I have Fedora installed in my laptop. This command works for any Red Hat based OS.
```
sudo dnf install sqlite3
```

We have created 2 sql files:
1. tables.sql: this table contains the name of tables, their fileds and their relationships required for the gwitter
2. dummydata.sql: We have the dummy data in this file. 

### Creating Database
```
sqlite3 gwitter.db
```

### To create and populate the database
```
.read tables.sql
```

### To import dummy file
```
.read dummydata.sql
```

### To quit
```
.exit
```