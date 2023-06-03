![diagram](./gtweet.drawio.png)

# WEEK 1

The task for Week 1 was to design database for Gwitter app using Squlite3.

The database was designed such that the user can SignUp, Login, Comment, Gweet and Follow other users.

For fulfulling the above requirements, the following tables were created in schema.sql.

### Creating Tables
We have created the following tables in schema.sql.

1. **user** : This table helps us to carry out the feature of Login and Sign up. We have the columns userid, firstName, lastName, username, password from the user in this table. 
* uid => integer and primary key
* firstname => varchar
* lastname => varchar
* username => varchar and unique
* password => varchar

2. **follow** : This table handles the feature relating to the follow. Here table has columns(id,follower,following). They are assigned the integer datatype and are autoincremented. id used as the foreign key to reference userID from users table.



3. **tweet** : This table handles the features of posting gweets. We have the columns id, gweet and userID in this table. id used as the foreign key to reference userID from user table.

4. **comments**: This table handles the features of commenting on the tweets. We have the header columns cmdID, cmt, gweetID. We have used the foreign key to reference gweetID,userId from tweet,user respectively table.

The Schema to create tables is available at tables.sql

The dummy data are available at dummydata.sql

The readme file to know about the commands to run the sql files is provided.