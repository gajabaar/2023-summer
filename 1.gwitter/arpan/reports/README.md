# Week 1.   SQLITE
For this week , we had to design a database in sqlite3 for our application Gwitter.

## Database Design
I created the following tables for the database:

```schema.sql```

1. **Users** : 

   This table is used when user signup , signin or login.
* user_id = unique for each user , integer , auto increment
* username = unique for each user
* password = password of each user

2. **Gweet** : 

   This table is used to gweet and view them.
* gweet_id = unique for each gweet
* gweet= content of gweet
* user_id = foreign key

3. **Comment** : 

   This table is used to store the comments on gweet and view them.
* comment_id = unique for each comment
* comment = to store the comments
* user_id and gweet_id

4. **Followers** : 

   This table is used for looking followers of an user.
* followers_id = id of people who follows user 

5. **Followings** : 

   This table is used for looking followings of an user.
* following_id = id of people whom user is following

```data.sql```

It has the dummy data for the database.



The installation , reading sql file and populating with database can be found [here.](../database/README.md)