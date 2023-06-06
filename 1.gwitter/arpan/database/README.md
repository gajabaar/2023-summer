# Database Design For Gwitter
## Database 
[schema.sql](./schema.sql) has the schema for the database.


[data.sql](./data.sql) has the dummy data that can be used in the database:


## Installation of sqlite3
It is preinstalled on Kali Linux.
If not present use the following command for debian based distro.

``` 
sudo apt install sqlite3 
```

## Database Creation and Populate with dummy data
I made the following sql files:
- schema.sql - It contains the schema of the database.
- data.sql - It contains dummy data.

### Importing sql files into the database in sqlite3
To open the sqlite3:
``` 
sqlite3 gwitter.db
 ```
 Lets import the sql files we made earlier into sqlite3:

```
.read schema.sql
.read data.sql
```
The schema.sql and data.sql should be on the same directory where we have opened the gwitter.db database.

To display the tables:
```
.tables
```

Other commands can be executed to perform other actions in the database.