<?php
$db = new SQLite3("database/gwitter.db");

if (isset($_POST['editClick'])) {
    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $title = $_POST['title'];
   
    $query = "UPDATE posts SET title = :title WHERE postId = :postId AND userId= :userId";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':postId', $postId);
    $stmt->bindValue(':title', $title);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: profile.php?msg=EditSuccessfull");
        exit();
    } else {
        
        header("Location: profile.php?msg=Error!tryAgain");
        exit();
    }
}

if (isset($_POST['deleteClick'])) {
    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
   
    $query = "DELETE FROM posts WHERE userId = :userId AND postId = :postId";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':postId', $postId);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: profile.php?msg=DeletionSuccessfull");
        exit();
    } else {
        
        header("Location: profile.php?msg=Error!tryAgain");
        exit();
    }
}

if (isset($_POST['addCommentClick'])) {
    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $username = $_POST['username'];
    $title = $_POST['comment'];
   
    $query = "INSERT INTO comments ('postId', 'userId', 'username', 'title') VALUES (:postId, :userId, :username, :title)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':postId', $postId);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':title', $title);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: profile.php?msg=CommentPostedSuccessfully");
        exit();
    } else {
        
        header("Location: profile.php?msg=Error!tryAgain");
        exit();
    }
}

if (isset($_POST['addCommentHomeClick'])) {
    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $username = $_POST['username'];
    $title = $_POST['title'];
   
    $query = "INSERT INTO comments ('postId', 'userId', 'username', 'title') VALUES (:postId, :userId, :username, :title)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':postId', $postId);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':title', $title);

    $result = $stmt->execute();

    if ($result) {
        
        header("Location: home.php?msg=CommentPostedSuccessfully");
        exit();
    } else {
        
        header("Location: home.php?msg=Error!tryAgain");
        exit();
    }
}


?>