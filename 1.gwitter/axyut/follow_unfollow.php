<?php
$db = new SQLite3("database/gwitter.db");

if (isset($_POST['followClick'])) {
    $userId = $_POST['userId'];
    $followingId = $_POST['followingId'];
    $followingUsername = $_POST['followingUsername'];
   
    $query = "INSERT INTO followings ('userId', 'followingId') VALUES (:userId, :followingId)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':followingId', $followingId);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: home.php?msg=FollowSuccessfull");
        exit();
    } else {
        
        header("Location: home.php?msg=Error!tryAgain");
        exit();
    }
}

if (isset($_POST['unfollowClick'])) {
    $userId = $_POST['userId'];
    $followingId = $_POST['followingId'];
    $followingUsername = $_POST['followingUsername'];
   
    $query = "DELETE FROM followings WHERE userId = :userId AND followingId = :followingId";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':followingId', $followingId);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: profile.php?msg=UnfollowSuccessfull");
        exit();
    } else {
        
        header("Location: profile.php?msg=Error!tryAgain");
        exit();
    }
}

if (isset($_POST['removeClick'])) {
    $userId = $_POST['userId'];
    $followerId = $_POST['followerId'];
    $followerUsername = $_POST['followerUsername'];
   
    $query = "DELETE FROM followers WHERE userId = :userId AND followerId = :followerId";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':followerId', $followerId);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: profile.php?msg=Removed$followerUsername");
        exit();
    } else {
        
        header("Location: profile.php?msg=Error!tryAgain");
        exit();
    }
}
?>