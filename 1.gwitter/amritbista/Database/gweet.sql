DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS gweets;
DROP TABLE IF EXISTS followers;

CREATE TABLE users(
	uid INTEGER primary key AUTOINCREMENT,
	username varchar(25) NOT NULL unique,
	password varchar(30)
);

CREATE TABLE gweets( 
	uid INTEGER  primary key AUTOINCREMENT,
	gweet text,
	username VARCHAR(30) NOT NULL,
	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);
CREATE TABLE followers(
	uid INTEGER,
	followed_by INTEGER,
	FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE,
	FOREIGN KEY (followed_by) REFERENCES users(uid) ON DELETE CASCADE,
	UNIQUE(uid,followed_by)

);

INSERT INTO users (username, password)
VALUES
    ("admin", "admin"),
    ("user1", "user1"),
    ("user2", "user2"),
    ("user3", "user3"),
    ("user", "user")
    ;
    
INSERT INTO gweets (username, gweet)
VALUES
    ("user1","Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, distinctio?"),
    ("user2","Lorem ipsum dolor sit, amet consectetur adipisicing elit. Pariatur dicta est excepturi voluptatum totam ut quod voluptate voluptas eveniet officia."),
    ("user3","Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, nihil nobis aliquam eaque itaque repudiandae!"),
    ("user","Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, voluptatem.")
    ;

INSERT INTO followers (uid, followed_by)
VALUES
    (3, 2), (3, 1), (3, 4), (3, 5),
    (1, 2), (1, 4), (1, 3),
    (2, 3), (2, 1),
    (4, 1), (4, 3), 
    (5, 1)
    ;
