DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS gweets;
DROP TABLE IF EXISTS followers;

CREATE TABLE users(
	id INTEGER primary key AUTOINCREMENT,
	username varchar(25) unique,
	password varchar(30)
);

CREATE TABLE gweets( 
	id INTEGER  primary key AUTOINCREMENT,
	gweet text,
	user_id INTEGER,
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE followers(
	uid INTEGER,
	followed_by INTEGER,
	FOREIGN KEY (uid) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (followed_by) REFERENCES users(id) ON DELETE CASCADE,
	UNIQUE(uid,followed_by)

);

PRAGMA foreign_keys = ON;