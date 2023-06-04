DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Gweets;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Followers;
DROP TABLE IF EXISTS Likes;

CREATE TABLE "Users"(
    [userId]   INTEGER NOT NULL PRIMARY KEY,
    [username] VARCHAR(64) NOT NULL UNIQUE,
    [password] VARCHAR(64) NOT NULL,
    [joinedOn] DATE DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE "Gweets"(
    [gweetId]   INTEGER NOT NULL PRIMARY KEY,
    [userId]    INTEGER NOT NULL,
    [data]      VARCHAR(512),
    [original]  INTEGER,
    [timestamp] DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,

    CHECK(([data] IS NOT NULL) <> ([original] IS NOT NULL))

    FOREIGN KEY([userId]) REFERENCES Users([userId])
        ON DELETE CASCADE
        ON UPDATE CASCADE

    FOREIGN KEY([original]) REFERENCES Gweets([gweetId])
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE "Comments"(
    [commentId] INTEGER NOT NULL PRIMARY KEY,
    [gweetId]    INTEGER NOT NULL,
    [parent]    INTEGER,
    [userId]    INTEGER NOT NULL,
    [data]      VARCHAR(512),
    [timestamp] DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY([userId]) REFERENCES Users([userId])
        ON DELETE CASCADE
        ON UPDATE CASCADE

    FOREIGN KEY([gweetId]) REFERENCES Gweets([gweetId])
        ON DELETE CASCADE
        ON UPDATE CASCADE

    FOREIGN KEY([parent]) REFERENCES Comments([commentId])
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE "Followers"(
    [followerId] INTEGER NOT NULL,
    [followeeId] INTEGER NOT NULL,
    [since]      DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,

    PRIMARY KEY([followeeId], [followeeId])

    FOREIGN KEY([followerId]) REFERENCES Users([userId])
        ON DELETE CASCADE
        ON UPDATE CASCADE
    
    FOREIGN KEY([followeeId]) REFERENCES Users([userId])
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE "Likes"(
    [likedGweet] INTEGER NOT NULL,
    [likedBy]   INTEGER NOT NULL,
    [timestamp] DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY([likedGweet]) REFERENCES Gweets([gweetId])
        ON DELETE CASCADE
        ON UPDATE CASCADE

    FOREIGN KEY([likedBy]) REFERENCES Users([userId])
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

 