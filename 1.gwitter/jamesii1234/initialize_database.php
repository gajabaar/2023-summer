<?php
$dbFile = 'gwitter.db';
$db = new SQLite3($dbFile);

// Create the "userlogin" table
$queryUserLogin = "
    CREATE TABLE IF NOT EXISTS userlogin (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        firstname TEXT NOT NULL,
        lastname TEXT NOT NULL,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )
";
$db->exec($queryUserLogin);

// Create the "gweet" table
$queryGweet = "
    CREATE TABLE IF NOT EXISTS gweet (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username VARCHAR(255),
        gweet VARCHAR(280),
        likes INTEGER DEFAULT 0,
        FOREIGN KEY (username) REFERENCES userlogin(username)
    )
";
$db->exec($queryGweet);

// Create the "comments" table
$queryComments = "
    CREATE TABLE IF NOT EXISTS comments (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        gweet_id INTEGER NOT NULL,
        username TEXT NOT NULL,
        comment TEXT NOT NULL,
        FOREIGN KEY (gweet_id) REFERENCES gweet(id),
        FOREIGN KEY (username) REFERENCES userlogin(username)
    )
";
$db->exec($queryComments);

// Create the "follower_following" table
$queryFollowerFollowing = "
    CREATE TABLE IF NOT EXISTS follower_following (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        follower_username VARCHAR(255) NOT NULL,
        following_username VARCHAR(255) NOT NULL,
        FOREIGN KEY (follower_username) REFERENCES userlogin(username),
        FOREIGN KEY (following_username) REFERENCES userlogin(username)
    )
";
$db->exec($queryFollowerFollowing);
?>
