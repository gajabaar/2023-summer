<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$dbFile = 'gwitter.db';
$db = new SQLite3($dbFile);



$loggedInUsername = $_SESSION['username'];
$profileUsername = $_GET['username'];

// Check if the user is viewing their own profile
$isOwnProfile = false;
if ($_SESSION['username'] === $_GET['username']) {
    $isOwnProfile = true;
}

// Display follow/following button if it's not the user's own profile
if (!$isOwnProfile) {
    // Check if the user is already following the profile user
    $queryFollow = "SELECT * FROM follower_following WHERE follower_username = :follower AND following_username = :following";
    $statementFollow = $db->prepare($queryFollow);
    $statementFollow->bindValue(':follower', $loggedInUsername);
    $statementFollow->bindValue(':following', $profileUsername);
    $resultFollow = $statementFollow->execute();
    $isFollowing = $resultFollow && $resultFollow->fetchArray();

    echo "<div class='follow-section'>";
    if ($isFollowing) {
        echo "<button class='unfollow-btn' data-following='" . $profileUsername . "'>Unfollow</button>";
    } else {
        echo "<button class='follow-btn' data-following='" . $profileUsername . "'>Follow</button>";
    }
    echo "</div>";
}

// Query the database to get the user's firstname
$query = "SELECT firstname, lastname FROM userlogin WHERE username = :username";
$statement = $db->prepare($query);

if ($statement) {
    $statement->bindValue(':username', $profileUsername);
    $result = $statement->execute();

    if ($result) {
        $row = $result->fetchArray();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        echo '<img src="./3106773.png" class="pic" alt="">';
        echo"<div class='profile-info'>";
        echo "" . $firstname . " " . $lastname;
        echo"</div>";
    }
}
echo "<a href='/home.php' class='home'>Home</a>";
// Query the database to get the user's gweets
$querygweet = "SELECT * FROM gweet WHERE username = :username";
$statementgweet = $db->prepare($querygweet);

if ($statementgweet) {
    $statementgweet->bindValue(':username', $profileUsername);
    $resultgweet = $statementgweet->execute();

    if ($resultgweet) {
        while ($rowgweet = $resultgweet->fetchArray(SQLITE3_ASSOC)) {
            $gweetId = $rowgweet['id'];
            $likesCount = $rowgweet['likes'];
            $liked = isset($_SESSION['liked_gweets'][$gweetId]) ? $_SESSION['liked_gweets'][$gweetId] : false;

            echo "<div class='gweet-container'>";
            echo "<p class='gweet-text'>" . $rowgweet['gweet'] . "</p>";
            echo "<p class='likes-count'>Likes: " . $likesCount . "</p>";
            echo "<button class='like-btn' data-gweet-id='" . $gweetId . "' data-liked='" . ($liked ? '1' : '0') . "'>" . ($liked ? 'Liked' : 'Like') . "</button>";

            // Display comments
            echo "<div class='comments-section'>";
            echo "<h4>Comments</h4>";

            $queryComments = "SELECT * FROM comments WHERE gweet_id = :gweet_id";
            $statementComments = $db->prepare($queryComments);
            $statementComments->bindValue(':gweet_id', $gweetId);
            $resultComments = $statementComments->execute();

            if ($resultComments) {
                while ($rowComment = $resultComments->fetchArray(SQLITE3_ASSOC)) {
                    echo "<p><strong>" . $rowComment['username'] . ": </strong>" . $rowComment['comment'] . "</p>";
                }
            }

            // Comment form
            echo "<form class='comment-form' method='POST' action='comment.php'>";
            echo "<input type='hidden' name='gweet_id' value='" . $gweetId . "'>";
            echo "<input type='text' name='comment' placeholder='Add a comment'>";
            echo "<button type='submit'>Comment</button>";
            echo "</form>";

            echo "</div>"; // End comments-section

            echo "</div>"; // End gweet-container
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
   <link rel="stylesheet" href="./css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="./js/profile.js"></script>
</head>
<body>
    
</body>
</html>
