# Gwitter Database

I have created four databases table in this Gwitter Database. They are as follows:

- USERS
- FOLLOWERS
- FOLLOWINGS
- GWEETS
- LIKES
- COMMENTS
- SHARE
- REPOST
- MESSAGES

## Getting into the database tables.

In this section, we will be explain what each database table is created.

<details>

<summary>Click here to explore the database tables.</summary>

### `USERS` Table

```sqlite
CREATE TABLE USERS
(
    ID        INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    NAME      TEXT                              NOT NULL,
    PASSWORD  VARCHAR(20)                       NOT NULL,
    JOINED_ON DATE DEFAULT CURRENT_TIMESTAMP    NOT NULL,

    CHECK ( length(PASSWORD) >= 6 )
);
```

Above SQl Query creates table with following columns **ID**, **NAME**, **PASSWORD**, and **JOINED_ON**

### `FOLLOWERS` Table

This table is used to keep track of those people who are following that user.

```sqlite
CREATE TABLE FOLLOWERS
(
    ID          INTEGER PRIMARY KEY NOT NULL,
    USER_ID     INTEGER             NOT NULL,
    FOLLOWER_ID INTEGER             NOT NULL,

    FOREIGN KEY (FOLLOWER_ID)
        REFERENCES USERS (ID),

    FOREIGN KEY (USER_ID)
        REFERENCES USERS (ID)
);
```

The code creates a table called "**FOLLOWERS**" to track the relationship between users and their followers. It has
three
columns: **ID**, **USER_ID**, and **FOLLOWER_ID**. The ID column is the primary key, and the USER_ID and FOLLOWER_ID
columns cannot
be null. _Two FOREIGN KEY constraints ensure that the values in the FOLLOWER_ID and USER_ID columns correspond to
existing user IDs in the USERS table_.

### `FOLLOWINGS` Table

This table keep track of those user who are following that particular user.

```sqlite
CREATE TABLE FOLLOWINGS
(
    ID           INTEGER PRIMARY KEY NOT NULL,
    USER_ID      INTEGER             NOT NULL,
    FOLLOWING_ID INTEGER             NOT NULL,

    FOREIGN KEY (FOLLOWING_ID)
        REFERENCES USERS (ID),

    FOREIGN KEY (USER_ID)
        REFERENCES USERS (ID)
);
```

The code creates a table called "**FOLLOWINGS**" to track the relationship between users and the accounts they follow.
It
has three columns: **ID**, **USER_ID**, and **FOLLOWING_ID**. The ID column is the primary key, and the USER_ID and
FOLLOWING_ID
columns cannot be null. _Two FOREIGN KEY constraints ensure that the values in the FOLLOWING_ID and USER_ID columns
correspond to existing user IDs in the USERS table. This table allows for effective management of user-following
relationships_.

### `GWEETS` Table

It keep track of the Gweet that has been post by that particular users.

```sqlite
CREATE TABLE GWEETS
(
    ID          INTEGER PRIMARY KEY AUTOINCREMENT  NOT NULL,
    USER_ID     INTEGER                            NOT NULL,
    CAPTION     TEXT                               NOT NULL,
    VIEW_COUNT  INTEGER                            NOT NULL,
    POSTED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY (USER_ID)
        REFERENCES USERS (ID),

    CHECK ( VIEW_COUNT >= 0 )
);
```

The code creates a table called "**GWEETS**" to store gweets, which are posts or messages. It has five columns: **ID**,
**USER_ID**,
**CAPTION**, **VIEW_COUNT**, and **POSTED_DATE**. The table ensures referential integrity with a foreign key constraint
on the
USER_ID column and includes a check constraint to ensure VIEW_COUNT is not negative.

### `COMMENTS` Table

This table is used to keep track of the comment in the tweet done by the user.

```sqlite
CREATE TABLE COMMENTS
(
    ID       INTEGER PRIMARY KEY AUTOINCREMENT  NOT NULL,
    GWEET_ID INTEGER                            NOT NULL,
    USER_ID  INTEGER                            NOT NULL,
    COMMENT  TEXT                               NOT NULL,
    DATE     DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY (USER_ID)
        REFERENCES USERS (ID),

    FOREIGN KEY (GWEET_ID)
        REFERENCES GWEETS (ID)
);
```

The code creates a table called "**COMMENTS**" to store comments made on gweets. It consists of five columns: **ID**, *
*GWEET_ID**,
**USER_ID**, **COMMENT**, and **DATE**. The ID column serves as the primary key, automatically incrementing for each new
comment.
The GWEET_ID column stores the ID of the gweet being commented on, while the USER_ID column stores the ID of the user
who made the comment. The COMMENT column contains the text content of the comment, and the DATE column records the date
and time when the comment was made, with a default value of the current timestamp. _The table includes foreign key
constraints to ensure that the USER_ID references a valid user ID from the USERS table and the GWEET_ID references a
valid gweet ID from the GWEETS table_

### `LIKES` Table

This table is used to keep track of the people we have liked the gweets.

```sqlite
CREATE TABLE LIKES
(
    ID       INTEGER PRIMARY KEY NOT NULL,
    GWEET_ID INTEGER             NOT NULL,
    LIKED_BY INTEGER             NOT NULL,
    FOREIGN KEY (LIKED_BY)
        REFERENCES USERS (ID),

    FOREIGN KEY (GWEET_ID)
        REFERENCES GWEETS (ID)
);
```

The code creates a table called "**LIKES**" to track the likes received by gweets. It has three columns: **ID**, *
*GWEET_ID**, and
**LIKED_BY**. The table includes foreign key constraints that ensure the LIKED_BY value corresponds to a valid user ID
from
the USERS table, and the GWEET_ID value corresponds to an existing gweet ID from the GWEETS table. This table allows for
the recording of gweet likes and their associations with users and gweets.

### `SHARE` Table

This table is used to keep track who have share the gweet.

```sqlite
CREATE TABLE SHARE
(
    ID        INTEGER PRIMARY KEY NOT NULL,
    GWEET_ID  INTEGER             NOT NULL,
    SHARED_BY INTEGER             NOT NULL,

    FOREIGN KEY (SHARED_BY)
        REFERENCES USERS (ID),
    FOREIGN KEY (GWEET_ID)
        REFERENCES GWEETS (ID)

);
```

The code creates a table called "**SHARE**" to track the sharing of gweets. It has three columns: **ID**, **GWEET_ID**,
and
**SHARED_BY**. The table includes foreign key constraints that ensure the SHARED_BY value corresponds to a valid user ID
from the USERS table, and the GWEET_ID value corresponds to an existing gweet ID from the GWEETS table. This table
enables the recording of gweet shares and their associations with users and gweets.

### `REPOST` Table

This table is used to keep track of the user who have repost the gweet.

```sqlite
CREATE TABLE REPOST
(
    ID        INTEGER PRIMARY KEY NOT NULL,
    REPOST_BY INTEGER             NOT NULL,
    GWEET_ID  INTEGER             NOT NULL,

    FOREIGN KEY (REPOST_BY)
        REFERENCES USERS (ID),
    FOREIGN KEY (GWEET_ID)
        REFERENCES GWEETS (ID)
);
```

The code creates a table called "**REPOST**" to track the reposting of gweets. It has three columns: **ID**, **REPOST_BY
**, and
**GWEET_ID**. The table includes foreign key constraints to ensure that the REPOST_BY value corresponds to a valid user
ID
from the USERS table, and the GWEET_ID value corresponds to an existing gweet ID from the GWEETS table. This table
enables the recording of gweet reposts and their associations with users and gweets.

### `MESSAGES` Table

This table is used to keep track of the message that has been send from one user to another user.

```sqlite
CREATE TABLE MESSAGES
(
    ID            INTEGER PRIMARY KEY NOT NULL,
    MESSAGED_FROM INTEGER             NOT NULL,
    MESSAGED_TO   INTEGER             NOT NULL,
    MESSAGE       TEXT                NOT NULL,
    DATETIME      DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (MESSAGED_FROM)
        REFERENCES USERS (ID),
    FOREIGN KEY (MESSAGED_TO)
        REFERENCES USERS (ID)
);
```

The code creates a table called "**MESSAGES**" to store user messages. It has five columns: **ID**, **MESSAGED_FROM**, **MESSAGED_TO**,
**MESSAGE**, and **DATETIME**. The table includes foreign key constraints to ensure that the MESSAGED_FROM and MESSAGED_TO
values correspond to valid user IDs from the USERS table. This table allows for the storage of messages, including
sender, recipient, content, and timestamp.
</details>



