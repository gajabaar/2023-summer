## Installing SQLITE
`sudo apt install sqlite3`

### `schema.sql`
This file contains the design or schema for the `gwitter.db`.
It contains the table for 
* Users
* Followed by
* Gweets

This sql file can be executed using command.
```
sqlite3
```
```
.read schema.sql
```
### `testdata.sql`
Like wise it contains the test data for `gwitter.db`
This sql file can be executed using command.
```
.read testdata.sql
```

The data can be printed or accessed using command
```
SELECT * FROM {users/followed_by/gweets} //select only one and remove curly braces and slash sign.
```