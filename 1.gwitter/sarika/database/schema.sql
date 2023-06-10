CREATE TABLE users(
    userID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT, 
    firstName VARCHAR(245) NOT NULL,
    lastName VARCHAR(245) NOT NULL,
    username VARCHAR(245) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL
);

CREATE TABLE followers(
    userID INTEGER NOT NULL,
    followersID INTEGER NOT NULL,
    FOREIGN KEY(userID) REFERENCES users(userID),
    FOREIGN KEY (followersID) REFERENCES users(userID)
);

CREATE TABLE followings(
    userID INTEGER NOT NULL,
    followingID INTEGER NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (followingID) REFERENCES users(userID)
);

CREATE TABLE gweets(
    gweetID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    gweet VARCHAR(245) NOT NULL,
    userID INTEGER NOT NULL, 
    FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE comments(
    commentID INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    comment VARCHAR(245) NOT NULL,
    gweetID INTEGER NOT NULL,
    userID INTEGER NOT NULL,
    FOREIGN KEY(gweetID) REFERENCES gweets(gweetID),
    FOREIGN KEY(userID) REFERENCES users(userID)
);
