## Week 1 report:
For first week we had to design and implement a database for Gwitter. Likely, we need the following tables for gwitter application.
* User (username, password)
* followed_by (username, follows)
* Gweet (username, gweet)

First of all we need to install sqlite3 on our machines.
For that:
`sudo apt install sqlite3`
The sqlite3 interface could be accessed in CLI using command `sqlite3`.
As the database could be made on CLI interface, I decided to opt out for VS code to write SQL commands and save it in file with extenstion `<fileName>.sql` .

The database is designed as for the features login, follow and post gweets.

For the tables
1. User
* id - integer and primary key.
* username - varchar and unique
* passkey - text

This table will handle login.

2. Followed by
* id - integer and primary key.
* username - varchar and in reference to username on table `user`
* follows -varchar and in reference to username on table `user`

This table will store the data of username and followed by.

3.Gweets
*  id - integer and primary key.
* gweet - text and not null
* username - varchar and in reference to username on table `user`

This table will handle users gweets.

ON DELETE CASCADE - This clause specifies that if a user is deleted from the "users" table, all corresponding gweets associated with that user will also be deleted.

