<?php
session_start();

// Check if the user is not logged in, redirect to signin.php
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

// Connect to the database using PDO
$db = new PDO('sqlite:gwitter.db');

// Get the user ID of the currently logged-in user
$user_id = $_SESSION['id'];

// Retrieve the user IDs of the users the logged-in user follows
$query = "SELECT followee_id FROM followings WHERE follower_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$followed_user_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Query the database to retrieve the tweets from the followed users
$query = "SELECT tweets.content, tweets.created_at, users.username, COUNT(likes.id) AS likes_count
          FROM tweets
          INNER JOIN users ON tweets.user_id = users.id
          LEFT JOIN likes ON likes.tweet_id = tweets.id
          WHERE tweets.user_id IN (" . implode(',', $followed_user_ids) . ")
          GROUP BY tweets.id
          ORDER BY tweets.created_at DESC";
$result = $db->query($query);
$tweets = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gwitter | Home</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
<header>
    <h1>Gwitter</h1>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logut.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
    <div class="tweets">
        <?php foreach ($tweets as $tweet) { ?>
            <div class="tweet">
                <p><strong><?php echo $tweet['username']; ?>:</strong> <?php echo $tweet['content']; ?></p>
                <p><?php echo $tweet['created_at']; ?></p>
                <p>Likes: <?php echo $tweet['likes_count']; ?></p> <!-- Display the likes count -->
            </div>
        <?php } ?>
    </div>
</main>
<footer>
    <p>&copy; 2023 Gwitter</p>
</footer>
</body>
</html>
