<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$dbFile = 'gwitter.db';
$db = new SQLite3($dbFile);

$loggedInUsername = $_SESSION['username'];
$profileUsername = $_POST['following'];

// Check if the user is already following the profile user
$queryCheck = "SELECT * FROM follower_following WHERE follower_username = :follower_username AND following_username = :following_username";
$statementCheck = $db->prepare($queryCheck);
$statementCheck->bindValue(':follower_username', $loggedInUsername);
$statementCheck->bindValue(':following_username', $profileUsername);
$resultCheck = $statementCheck->execute();
$alreadyFollowing = ($resultCheck && $resultCheck->fetchArray()) ? true : false;

if ($alreadyFollowing) {
    // Delete the record from the follower_following table
    $queryDelete = "DELETE FROM follower_following WHERE follower_username = :follower_username AND following_username = :following_username";
    $statementDelete = $db->prepare($queryDelete);
    $statementDelete->bindValue(':follower_username', $loggedInUsername);
    $statementDelete->bindValue(':following_username', $profileUsername);
    $resultDelete = $statementDelete->execute();

    if ($resultDelete) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'not_following';
}
?>
