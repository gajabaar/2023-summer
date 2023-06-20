<?php

// Establish a connection to the SQLite database
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new SQLite3('/usr/src/app/database/gwitter.db');

// Check for errors during database connection
if (!$db) {
    die("Database connection error: " . $db->lastErrorMsg());
}
// Retrieve user information
function getUserInfo($userID) {
    global $db;
    $query = $db->prepare('SELECT * FROM users WHERE userID = ?');
    $query->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $result = $query->execute();
    return  $result->fetchArray(SQLITE3_ASSOC);
}

// Get user posts
function getUserPosts($userID) {
    $db = new SQLite3('/usr/src/app/database/gwitter.db');
    $stmt = $db->prepare('SELECT * FROM gweets WHERE userID = :userID');
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    // $stmt = $db->prepare('SELECT * FROM Gweet  ');
    $result = $stmt->execute();
    $posts = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $posts[] = $row;
    }
    $stmt->close();
    $db->close();
    return $posts;
}

// Retrieve comments for a post
function getPostComments($postId) {
    global $db;
    $query = $db->prepare('SELECT * FROM comments WHERE gweetID = :gweetID');
    $query->bindValue(':gweetID', $postId, SQLITE3_INTEGER);
    $result = $query->execute();
    $comments = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $comments[] = $row;
    }
    return $comments;
}

// Retrieve all gweets
function getAllGweets() {
    global $db;
    $query = $db->prepare('SELECT * FROM gweets JOIN users ON gweets.userID = users.userID');
    $result = $query->execute();
    $posts = array();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $posts[] = $row;
    }
    return $posts;
}


// Add a new gweet to the database
function addGweet($gweet, $userID) {
    $db = new SQLite3('/usr/src/app/database/gwitter.db');
    $stmt = $db->prepare('INSERT INTO gweets (gweet, userID) VALUES (:gweet, :userID)');
    $stmt->bindValue(':gweet', $gweet, SQLITE3_TEXT);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    // Execute the statement and check for errors
    $result = $stmt->execute();
    if ($result) {
        header("Location: /Profile/profile.php");
    } else {
        echo "Error adding gweet: " . $db->lastErrorMsg();
    }
    $stmt->close();
    $db->close();
}

// Add a new comment to the database
function addComment($comment, $gweetID, $userID) {
    $db = new SQLite3('/usr/src/app/database/gwitter.db');
    $stmt = $db->prepare('INSERT INTO comments (comment, gweetID, userID) VALUES (:comment, :gweetID, :userID)');
    $stmt->bindValue(':comment', $comment,SQLITE3_TEXT );
    $stmt->bindValue(':gweetID', $gweetID, SQLITE3_INTEGER);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);

    $result = $stmt->execute();
    if ($result) {
        header("Location: /Profile/profile.php");
    } else {
        echo "Error adding comment: " . $db->lastErrorMsg();
    }
    $stmt->close();
    $db->close();
}
?>