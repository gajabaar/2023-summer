<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo 'error: user not logged in';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'error: invalid request';
    exit;
}

$dbFile = 'gwitter.db';
$db = new SQLite3($dbFile);

$gweetId = $_POST['gweet_id'];
$comment = $_POST['comment'];
$username = $_SESSION['username'];

$query = "INSERT INTO comments (gweet_id, username, comment) VALUES (:gweet_id, :username, :comment)";
$statement = $db->prepare($query);

if ($statement) {
    $statement->bindValue(':gweet_id', $gweetId);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':comment', $comment);

    $result = $statement->execute();

    if ($result) {
        // echo 'success';
        // header("Location: profile.php");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo 'error: failed to add comment';
    }
} else {
    echo 'error: failed to prepare statement';
}

$db->close();
?>
