<?php
require_once '../handler.php';

// Start the session
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

// Get all gweets on feed
$posts = getAllGweets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter</title>
    <link rel="stylesheet" href="../Styling/feeds.css">
</head>
<body>

    <h2>See what your friends posted</h2>
    <h4>You can't comment, we pretend to give you free speech!</h4>
    <?php foreach ($posts as $post): ?>
        <div class= "gweets-container">
        <i class="username"><?php echo htmlspecialchars($post["username"]); ?></i>
        <p class="gweets"><?php echo htmlspecialchars($post['gweet']); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>