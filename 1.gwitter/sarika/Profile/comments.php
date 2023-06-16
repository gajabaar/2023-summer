<?php
require_once '../handler.php';

// Start the session
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
} 

$userID = $_SESSION["userID"];

// Get the gweet ID from the query string
if (isset($_GET['gweetID'])) {
    $gweetID = $_GET['gweetID'];
} else {
    echo 'Error: Gweet ID not specified.';
    exit;
}

// Get the comments for the gweet
$comments = getPostComments($gweetID);


// Handle new comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
        addComment($comment, $gweetID, $userID);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styling/comments.css">
    <title>Gwitter - Comments</title>
</head>
<body>
    <h2>Comments</h2>
    <?php foreach ($comments as $comment): ?>
        <i class="username"><?php echo htmlspecialchars($_SESSION["username"]); ?></i>
        <p class="comments"><?php echo htmlspecialchars($comment['comment']); ?></p>
        <hr>
    <?php endforeach; ?>

    <form action="comments.php?gweetID=<?php echo $gweetID; ?>" method="POST">
   
        <input type="hidden" name="gweetID" value="<?php echo $gweetID; ?>">

        <textarea name="comment" placeholder="Enter your comment" required></textarea>
        <input  id="submit" type="submit" value="Submit">
    </form>
</body>
</html>