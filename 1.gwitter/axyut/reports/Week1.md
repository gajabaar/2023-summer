# Reports

## Week 1 - SQLite Essentials

This is a report detailing the database design and why it is designed this way. We are using a fast relational database called sqlite database.

### Basics of Sqlite3

- Sqlite Commandline Interface can be accessed with command `sqlite3 <file.db>` in terminal
- While the industry standard is the use of Capital letters, small letters can also be used to execute commands `CREATE == create`.
- `.schema` and `.tables` can be used to see the schema and all the tables in the database.
- CRUD functionality can be achieved with INSERT, SELECT, UPDATE and DROP.

### Files

- File `gwitter.db` is to be created if it already doesn't exist, create or open with $ `sqlite3 gwitter.db`
- File `schema.sql`, includes the building blocks of our database, it can be used to create all the basic tables for our app such as, `Users, Posts, Comments, Followers, Followings`. This file can be read by our database with `.read schema.sql`
- File `populate.sql`, includes list of queries which can efficiently fill up the database with template user's data upto 10 rows. This file can be read by our database with `.read populate.sql`
- File `query.sql`, includes all the queries that can be executed without the specific input from the user. This file can be read by our database with `.read query.sql`. This file generally includes admin queries.
- File `userQuery.sql` includes queries that cannot be read by sqlite command like `.read userQuery.sql` because a language should be in place to take the input from the user. This file includes queries that has only user level permission to data.

### Working

- Go inside the directory database, `cd 1.gwitter/axyut/database`,
- Execute `sqlite3 gwitter.db` this will open the database file, if the file doesn't already exist it will create a new db dile for us.
- Check for the available tables with `.tables`, If nothing shows up, populate the database with populate.sql, `.read populate.sql`, if successfull it will show the newly created tables.
- Run your queries as required, the file `query.sql` can help with some basic admin queries to be executed.
- Additional user specific queries can be executed with the help of userQuery.sql file, to find the required data of user, replace your text at `<input>`.

### Design Structure

The tables user, post, comment, follower and following are put in place to maximize the functionality and speed of query execution.

- `Users` table stores id, username and password of the user that is used to register and provides general access to other features such as user's gweets.
- `Posts` table stores all the gweets of all of the users with its own unique id, title, description and is linked with id from user table as UserId.
- `Comments` table is put in place with convient in mind, when user gweet inside a gweet, it is considered as a comment, it stores its own unique id, title as in gweet description, PostId to link it with it's gweet and UserId to link it with it's original owner to bring the functionality of edit, delete of gweet by only its user
- `Followings` and `Followers` tables stores only the UserIds of Users table and FollowingId & FollowerId both of which are UserIds from Users table.
