CREATE TABLE Users(
	name VARCHAR(128)  CHECK (LENGTH(name) > 0),
	username VARCHAR(128) UNIQUE PRIMARY KEY CHECK (LENGTH(username) > 0),
	password BLOB NOT NULL,
	birthday DATE NOT NULL
);
