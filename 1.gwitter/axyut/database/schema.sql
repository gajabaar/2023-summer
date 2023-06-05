
DROP TABLE IF EXISTS "Users";
CREATE TABLE "Users"(
    [UserId] INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    [Username] VARCHAR(20) NOT NULL ,
    [Password] VARCHAR(20) NOT NULL CHECK (length(password) >= 8)
);

DROP TABLE IF EXISTS "Posts";
CREATE TABLE "Posts"(
	[PostId] INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
	[UserId] INTEGER NOT NULL,
	[Title] VARCHAR(240) NOT NULL,
	FOREIGN KEY([UserId]) 
	REFERENCES "Users"([UserId]) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS "Comments";
CREATE TABLE "Comments" (
	[CommentId] INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
	[PostId] INTEGER NOT NULL,
	[UserId] INTEGER NOT NULL,
	[Title] VARCHAR(240) NOT NULL,
	FOREIGN KEY([PostId]) 
	REFERENCES "Posts"([PostId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY([UserId]) 
	REFERENCES "Users"([UserId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

DROP TABLE IF EXISTS "Followings";
CREATE TABLE "Followings"(
	[UserId] INTEGER NOT NULL,
	[FollowingId] INTEGER NOT NULL,
	FOREIGN KEY([UserId]) 
	REFERENCES "Users"([UserId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY([FollowingId]) 
	REFERENCES "Users"([UserId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

DROP TABLE IF EXISTS "Followers";
CREATE TABLE "Followers" (
	[UserId] INTEGER NOT NULL,
	[FollowerId] INTEGER NOT NULL,
	FOREIGN KEY([UserId]) 
	REFERENCES "Users"([UserId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY([FollowerId]) 
	REFERENCES "Users"([UserId])
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

PRAGMA foreign_keys = ON;