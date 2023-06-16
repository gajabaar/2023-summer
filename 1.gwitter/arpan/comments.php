<?php
require_once 'functions.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
} 

$userId = $_SESSION["user_id"];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$gweetId = isset($_GET['gweet_id']) ? intval($_GET['gweet_id']) : 0;
if (!checkGweetOwnership($gweetId)) {
    echo 'Error: Invalid Gweet ID.';
    exit;
}

$gweetInfo = getGweetInComment($gweetId);
if (!$gweetInfo) {
    echo 'Error: Invalid Gweet ID.';
    exit;
}

$gweet = htmlspecialchars($gweetInfo['gweet']);
$ownerUsername = htmlspecialchars($gweetInfo['username']);

$comments = getComments($gweetId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = htmlspecialchars($_POST['comment']);
    addComment($comment, $gweetId, $userId);
    header('Location: comments.php?gweet_id=' . $gweetId);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter - Comments</title>
    <link rel="stylesheet" href="./css_files/comments.css">
</head>

<body>
    <div class="container">
        <div class="logout">
            <form action="profile.php" method="POST">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>

        <h1>User: <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
        <hr>
        <h2>Gweet:</h2>
        <div class="gweet">
            <i><?php echo "user:" . $ownerUsername; ?></i>
            <p><?php echo $gweet; ?></p>
            <br><br>
            <hr>
        </div>

        <h1>Comments:</h1>
        <div class="comment">
            <?php foreach ($comments as $comment): ?>
                <i><?php echo "user:" . htmlspecialchars($comment['username']); ?></i>
                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                <hr>
            <?php endforeach; ?>
        </div>

        <h2>Add Comment:</h2>
        <div class="newcomment">
            <form action="comments.php?gweet_id=<?php echo $gweetId; ?>" method="POST">
                <input type="hidden" name="gweet_id" value="<?php echo $gweetId; ?>">
                <textarea name="comment" placeholder="Enter your comment" required></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>
