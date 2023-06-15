DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS tweet;
DROP TABLE IF EXISTS follow;
DROP TABLE IF EXISTS comment;

CREATE TABLE user(
    userID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT, 
    firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(25) NOT NULL,
    username VARCHAR(35) NOT NULL UNIQUE,
    password VARCHAR(25) NOT NULL
);

CREATE TABLE tweet(
    id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    gtweet text,
    userID INTEGER NOT NULL, 
    FOREIGN KEY (userID) REFERENCES user(usD^Z
);

CREATE TABLE follow(
    id INTEGER NOT NULL,
    follower INTEGER NOT NULL,
    following INTEGER NOT NULL, 
    FOREIGN KEY (id) REFERENCES user(userID) ON DELETE CASCADE
);

CREATE TABLE comments(
    cmtID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    cmt text NOT NULL,
    gweetID INTEGER NOT NULL,
    userId INTEGER NOT NULL,
    FOREIGN KEY(gweetID) REFERENCES tweet(id) ON DELETE CASCADE,
    FOREIGN KEY(userId) REFERENCES user(userID) ON DELETE CASCADE
);
