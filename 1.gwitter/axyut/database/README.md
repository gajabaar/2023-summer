# SQLite Essentials

We are using a fast relational database called sqlite database.

- Sqlite Commandline Interface can be accessed with command `sqlite3 <file.db>` in terminal
- While the industry standard is the use of Capital letters, small letters can also be used to execute commands `CREATE == create`.
- `.schema` and `.tables` can be used to see the schema and all the tables in the database.
- CRUD functionality can be achieved with INSERT, SELECT, UPDATE and DROP.

### Working

- Go inside the directory database, `cd 1.gwitter/axyut/database`,
- Execute `sqlite3 gwitter.db` this will open the database file, if the file doesn't already exist it will create a new db dile for us.
- Check for the available tables with `.tables`, If nothing shows up, populate the database with populate.sql, `.read populate.sql`, if successfull it will show the newly created tables.
- Run your queries as required, the file `query.sql` can help with some basic admin queries to be executed.
- Additional user specific queries can be executed with the help of userQuery.sql file, to find the required data of user, replace your text at `<input>`.

### File Structure

- File `gwitter.db` is to be created if it already doesn't exist, create or open with $ `sqlite3 gwitter.db`
- File `schema.sql`, includes the building blocks of our database, it can be used to create all the basic tables for our app such as, `Users, Posts, Comments, Followers, Followings`.
- File `populate.sql`, includes list of queries which can efficiently fill up the database with template user's data upto 10 rows.
- File `query.sql`, includes all the queries that can be executed without the specific input from the user.
- File `userQuery.sql` includes queries that has only user level permission to data.
