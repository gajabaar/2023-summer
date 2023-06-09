
DROP TABLE IF EXISTS users;
CREATE TABLE users(
    userId INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL CHECK (length(password) >= 8)
);

DROP TABLE IF EXISTS posts;
CREATE TABLE posts(
	postId INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
	userId INTEGER NOT NULL,
	username VARCHAR(20) NOT NULL ,
	title VARCHAR(240) NOT NULL CHECK (length(title) >= 1),
	FOREIGN KEY(userId) 
	REFERENCES users(userId) 
		ON UPDATE CASCADE 
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments (
	commentId INTEGER NOT NULL UNIQUE PRIMARY KEY AUTOINCREMENT,
	postId INTEGER NOT NULL,
	userId INTEGER NOT NULL,
	username VARCHAR(20) NOT NULL ,
	title VARCHAR(240) NOT NULL CHECK (length(title) >= 1),
	FOREIGN KEY(postId) 
	REFERENCES posts(postId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY(userId) 
	REFERENCES users(userId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

DROP TABLE IF EXISTS followings;
CREATE TABLE followings(
	userId INTEGER NOT NULL,
	followingId INTEGER NOT NULL,
	FOREIGN KEY(userId) 
	REFERENCES users(userId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY(followingId) 
	REFERENCES users(userId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

DROP TABLE IF EXISTS followers;
CREATE TABLE followers (
	userId INTEGER NOT NULL,
	followerId INTEGER NOT NULL,
	FOREIGN KEY(userId) 
	REFERENCES users(userId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE,
	FOREIGN KEY(followerId) 
	REFERENCES users(userId)
		ON UPDATE CASCADE
       	ON DELETE CASCADE
);

PRAGMA foreign_keys = ON;