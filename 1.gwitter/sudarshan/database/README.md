# Database for Gwitter


### Prerequisites to run the database
- SQLite

### Installation (For Debian based distro)

```bash
sudo apt install sqlite3

```

### Create Database and Populate data.

#### SQL file present

1. **schema.sql** : Contains SQL queries that defines the name of tables, their fileds and their relationships required for the app.
2. **data.sql** : Contains SQL queries which populates the table created with some dummy data.

#### Create database

```sh
sqlite3 gwitter.db
```

#### Create and Populate Tables


- Import/Read file which contains the schema of the database.

```sqlite
.read schema.sql
```

- Now, Import the file which the dummy data.

```sqlite
.read data.sql
```

> Note that the commands are based when gwitter.db, schema.sql and data.sql are in the same location.


