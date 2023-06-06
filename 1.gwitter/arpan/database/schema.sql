CREATE TABLE User(
    user_id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE Gweet(
    gweet_id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT ,
    gweet VARCHAR(255) NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Comment(
    comment_id INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    comment VARCHAR(255) NOT NULL ,
    gweet_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (gweet_id) REFERENCES Gweet(gweet_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Follower(
    user_id INTEGER NOT NULL,
    follower_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (follower_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Following(
    user_id INTEGER NOT NULL,
    following_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (following_id) REFERENCES User(user_id)
           ON UPDATE CASCADE
        ON DELETE CASCADE
);
