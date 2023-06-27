<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$dbFile = 'gwitter.db';
$db = new SQLite3($dbFile);

$loggedInUsername = $_SESSION['username'];
$profileUsername = $_POST['username'];

// Check if the user is already following the profile user
$queryCheck = "SELECT * FROM follower_following WHERE follower_username = :follower_username AND following_username = :following_username";
$statementCheck = $db->prepare($queryCheck);
$statementCheck->bindValue(':follower_username', $loggedInUsername);
$statementCheck->bindValue(':following_username', $profileUsername);
$resultCheck = $statementCheck->execute();
$alreadyFollowing = ($resultCheck && $resultCheck->fetchArray()) ? true : false;

if (!$alreadyFollowing) {
    // Insert new record into the follower_following table
    $queryInsert = "INSERT INTO follower_following (follower_username, following_username) VALUES (:follower_username, :following_username)";
    $statementInsert = $db->prepare($queryInsert);
    $statementInsert->bindValue(':follower_username', $loggedInUsername);
    $statementInsert->bindValue(':following_username', $profileUsername);
    $resultInsert = $statementInsert->execute();

    if ($resultInsert) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'already_following';
}
?>
