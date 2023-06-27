<?php
$dbFile = './database/gwitter.db';

try {
    $db = new PDO('sqlite:' . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

function getUserInfo($userId) {
    global $db;
    $query = $db->prepare('SELECT * FROM User WHERE user_id = ?');
    $query->execute([$userId]);
    return $query->fetch(PDO::FETCH_ASSOC);
}
function getUserPosts() {
    global $db;
    $query = $db->query('SELECT Gweet.*, User.username FROM Gweet JOIN User ON Gweet.user_id = User.user_id ORDER BY Gweet.gweet_id DESC');
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getComments($postId) {
    global $db;
    $query = $db->prepare('SELECT Comment.*, User.username FROM Comment JOIN User ON Comment.user_id = User.user_id WHERE Comment.gweet_id = ?');
    $query->execute([$postId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getFollowers($userId) {
    global $db;
    $query = $db->prepare('SELECT * FROM Follower WHERE user_id = ?');
    $query->execute([$userId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getFollowings($userId) {
    global $db;
    $query = $db->prepare('SELECT * FROM Following WHERE user_id = ?');
    $query->execute([$userId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getGweetInComment($gweetId) {
    global $db;
    $query = $db->prepare('SELECT Gweet.gweet, User.username FROM Gweet JOIN User ON Gweet.user_id = User.user_id WHERE Gweet.gweet_id = ?');
    $query->execute([$gweetId]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function addGweet($gweet, $userId) {
    $db = new SQLite3('./database/gwitter.db');
    $stmt = $db->prepare('INSERT INTO Gweet (gweet, user_id) VALUES (:gweet, :userId)');
    $stmt->bindValue(':gweet', $gweet, SQLITE3_TEXT);
    $stmt->bindValue(':userId', $userId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
    $db->close();
}

function addComment($comment, $gweetId, $userId) {
    $db = new SQLite3('./database/gwitter.db');
    $stmt = $db->prepare('INSERT INTO Comment (comment, gweet_id, user_id) VALUES (:comment, :gweetId, :userId)');
    $stmt->bindValue(':comment', $comment,SQLITE3_TEXT );
    $stmt->bindValue(':gweetId', $gweetId, SQLITE3_INTEGER);
    $stmt->bindValue(':userId', $userId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $stmt->close();
    $db->close();
}

function checkGweetOwnership($gweetId) {
    $db = new SQLite3('./database/gwitter.db');
    $stmt = $db->prepare('SELECT COUNT(*) FROM Gweet WHERE gweet_id = :gweetId ');
    $stmt->bindValue(':gweetId', $gweetId, SQLITE3_INTEGER);
    $result = $stmt->execute()->fetchArray(SQLITE3_NUM);
    $db->close();
    return ($result && $result[0] > 0);
}

?>
