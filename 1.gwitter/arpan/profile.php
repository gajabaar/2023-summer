<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
} 

require_once 'functions.php';

$userId = $_SESSION["user_id"];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$userInfo = getUserInfo($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gweet'])) {
    $gweet = htmlspecialchars($_POST['gweet']);
    addGweet($gweet, $userId);
    header('Location: profile.php');
    exit;
}

$userPosts = getUserPosts($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter - Profile</title>
    <link rel="stylesheet" href="./css_files/profile.css">
</head>

<body>
    <div class="container">
        <div class="logout">
            <form action="profile.php" method="POST">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>

        <h1>User: <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>

        <div class="welcome-message">
            <p>Welcome to Gwitter, Dear <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></p>
        </div>

        <h2>Create New Gweet:</h2>
        <div class="newgweet">
            <form action="profile.php" method="POST">
                <textarea name="gweet" placeholder="Type your gweet here" required></textarea>
                <br>
                <button type="submit">Gweet</button>
            </form>
        </div>

        <h2>Gweets:</h2>
        <?php foreach ($userPosts as $post): ?>
            <div class="gweet">
                <i><?php echo "user:". htmlspecialchars($post["username"]); ?></i>
                <p><?php echo htmlspecialchars($post['gweet']); ?></p>
                <a href="comments.php?gweet_id=<?php echo htmlspecialchars($post['gweet_id']); ?>">View Comments</a>
                <br><br>
                <hr>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
