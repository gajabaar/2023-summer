Gwitter
Gwitter is my own personal version of Gwitter.

---

Week 1
The task for this week is to design the database of gwitter.
The database was designed with sqlite3.

### For Command line

`sudo apt install sqlite3` - to install sqlite3
`sqlite gwitter.db` - to create a db named gwitter
`Create table user(username text not null,password text not null)` - to create table named user with fields username & password of type text and not null as attribute
`.tables` - to view table
`Insert into user values(amrit,amrit)` - to insert amrit amrit into table user
`select * from user` - to view content of user table
`select username from user` - to only view usernames of user table
`update user set password = 'amrit123' where username = 'amrit';` - replaces password for username 'amrit' from table user
`drop table user` - to drop table namaed user
`.help` - to view list of commands or help
`.quit` - to exit

### to run from script

`vi gweet.sql` or any other text editor and write scripts in it as shown in gweet.sql
`sqlite3` - to run sql client
`.read gweet,sqk
`sqlite3 gweet.db`
`.read gweet.sql`
then code inside the file gweet.sql will be automatically updated

## User

It consists of the features/ fileds as:

- userid as uid
- username
- password

## Gweets

This table consists of fields like

- userid as uid (the userid of the respective person)
- gweet (the text that people have entered)

## Follower

It consists of 2 basic fields

- userid as uid
- follower id (or the people that have followed user)
