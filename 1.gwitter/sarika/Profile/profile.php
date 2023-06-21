<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
} 


require_once '../handler.php';

$userID = $_SESSION["userID"];

// Get user information
$userInfo = getUserInfo($userID);

// Handle new gweet submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gweet'])) {
    $gweet = $_POST['gweet'];
    addGweet($gweet, $userID);
    exit;
}
// Get user's posts
$userPosts = getUserPosts($userID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter - Profile</title>
    <link rel="stylesheet" href="../Styling/profile.css">
</head>
<body>
    <h2>Gweet the thoughts, <?php echo $_SESSION["username"]; ?></h2>

    <form action="profile.php" method="POST">
        <textarea name="gweet" placeholder="Enter your gweet..."></textarea>
        <button type="submit">Gweet</button>
    </form>

    <a href="./feeds.php">See all gweets</a>
    <?php foreach ($userPosts as $post): ?>
        <div class="gweets-container">
            <i class="username"><?php echo $_SESSION["username"]; ?></i>
            <p class="gweets"><?php echo htmlspecialchars($post['gweet']); ?></p>
            <a href="../Profile/comments.php?gweetID=<?php echo $post['gweetID']; ?>">View Comments</a>
            <br><br>
        </div>
    <?php endforeach; ?>
</body>
</html>