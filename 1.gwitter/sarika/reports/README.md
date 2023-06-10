# WEEK 1

The task for Week 1 was to design database for Gwitter app using Squlite3.

The database was designed such that the user can SignUp, Login, Comment, Gweet and Follow other users.

For fulfulling the above requirements, the following tables were created in schema.sql.

### Creating Tables
We have created the following tables in schema.sql.

1. **users** : This table helps us to carry out the feature of Login and Sign up. We have the columns userid, firstName, lastName, username, password from the user in this table. The username and userid is confined to be unique. The datatype has been assigned to each columns along with the character limits where necessary.

2. **followers** : This table handles the feature relating to the followers. We have the columns followersID, usersID in this table. They are assigned the integer datatype and are autoincremented. We have used the foreign key to reference userID from users table.

3. **following** :This table handles the feature relating to the following. We have the columns followingID, userID in this table. They are assigned the integer datatype and are autoincremented. We have used the foreign key to reference userID from users table.

4. **gweets** : This table handles the features of posting gweets. We have the columns gweetID, gweet and userID in this table. We have used the foreign key to reference userID from users table.

5. **comments**: This table handles the features of commenting on the gweets. We have the header columns commentID, comment, gweetID. We have used the foreign key to reference gweetID from gweets table.

The Schema to create tables is available at schema.sql

The dummy data are available at populate.sql

The readme file to know about the commands to run the sql files is provided.