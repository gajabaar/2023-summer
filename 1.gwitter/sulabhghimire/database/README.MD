# SQLite3 Database

## Tables
The databse schema or table information is stored in `schema.sql`.
### 1. Users
The Users table stores information about users, including their username, password, full name, and bio.
```sql
CREATE TABLE IF NOT EXISTS Users(
   UserID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
   UserName VARCHAR(20) NOT NULL UNIQUE,
   Password TEXT NOT NULL CHECK (length(Password) >=8),
   FullName TEXT NOT NULL,
   Bio TEXT 
);
```
- `UserID` is an `integer` that `uniquely` identifies each user, it is `primary key`, `can't be null` and is `increased automatically`..
- `UserName` is a `string` of up to `20 characters` that is used to identify the user, it `can't be null` and must be `unique` for each user.
- `Password` is a `string` that is used to authenticate the user and `can't be null`.
- `FullName` is a `string` that contains the user's full name and `can't be null`.
- `Bio` is a `string` that contains a brief biography of the user and `can remain null`.

***`Constraints`***  
The `Users` table has a constraint that ensures that the password is at least 8 characters long. This helps to protect user accounts from unauthorized access.

----
### 2. Posts
The Posts table stores information about posts, including the user who created the post, the content of the post, and the date and time the post was created.
```sql
CREATE TABLE IF NOT EXISTS Posts(
    PostID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    UserID INTEGER NOT NULL,
    content TEXT NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (UserID)
        REFERENCES Users (UserID)
            ON UPDATE NO ACTION
            ON DELETE CASCADE
);
```
- `PostID` is an `integer` that `uniquely` identifies each post, it `can't be null`, it is `primary key` and `auto-increments` for each entry.
- `UserID` is an `integer` that identifies the user who created the post, it `can't be null`.
- `Content` is a `string` that contains the content of the post and `can't be null`.
- `CreatedAt` is a `datetime` that indicates the `dateandtime` the post was created and its `default` value is set to `CURRENT_TIMESTAMP` of `dateandtime`.

***`Foregin Keys`***  
`UserID` is an foregin key in `Posts` table that references to the `UserID` in `Users` table. If the user with `UserID` is deleted then the corresponding post made by that user also gets `deleted`. If the user with `UserID` is updated then 'no action` is taken to the posr made by that user. 

----
### 3. Connections
The `Connections` table stores information about connections/following between users, including the user who initiated the connection (follower i.e. `WhoID`), the user who accepted the connection (user begin followed i.e. `WhomID`).
```sql
CREATE TABLE IF NOT EXISTS Connection(
    WhoID INTEGER NOT NULL,
    WhomID INTEGER NOT NULL,
    PRIMARY KEY (WhoID, WhomID),
    UNIQUE (WhoID, WhomID),
    FOREIGN KEY (WhoID)
        REFERENCES Users(UserID)
            ON UPDATE NO ACTION
            ON DELETE CASCADE,
    FOREIGN KEY (WhomID)
        REFERENCES Users(UserID)
            ON UPDATE NO ACTION
            ON DELETE CASCADE
);
```
- `WhoID` is an integer that identifies the user who initiated the connection.
- `WhomID` is an integer that identifies the user who accepted the connection.
- Combination of `WhoID` and `WhomID` make `Primary Key` for this table.

***`Foregin Keys & Constraints`***  
`WhomID` is an foregin key in `Connections` table that references to the `UserID` in `Users` table. If the user with `UserID` is deleted then the corresponding connection made by that user also gets `deleted`. If the user with `UserID` is updated then 'no action` is taken to the connection made by that user.  

`WhoseID` is an foregin key in `Connections` table that references to the `UserID` in `Users` table. If the user with `UserID` is deleted then the corresponding connection made by that user also gets `deleted`. If the user with `UserID` is updated then 'no action` is taken to the connection made by that user.

The `UNIQUE` constraint ensures that each pair of `WhoID` and `WhomID` values is unique.

---

## Dummy Data
Data for each table is created and stored in `populate.sql`.

---

## Make Database and Insert Data
This process can be done by running file `start.sh`. It can be done by navigating to folder location that contains this file and by running the command `sh start.sh`.