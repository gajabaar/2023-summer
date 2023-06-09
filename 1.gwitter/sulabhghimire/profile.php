<!DOCTYPE html>
<?php 
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}

$query = "SELECT * FROM Users WHERE UserID = :uid";
$statement = $database->prepare($query);
$statement->bindValue(':uid', $_SESSION['user_id']);
$results = $statement->execute();
$row = $results -> fetchArray();

?>
<html>

<head>
    <title> Gwitter </title>
</head>
<body>
    <h2>Profile : </h2>
    <a href="updateprofile.php">Update Profile</a> <br>
    Name : <?php echo $row['FullName']?> <br>
    User Name : <?php echo $_SESSION['username']?> <br>
    Bio : <?php echo $row['Bio']?>
<?php
    $quer= "SELECT COUNT(*) AS count FROM Connection WHERE WhoID = :iuid";
    $state= $database->prepare($quer);
    $state->bindValue(':iuid', $_SESSION['user_id']);
    $resul = $state->execute();
    $rowfo = $resul -> fetchArray();

    $quer= "SELECT COUNT(*) AS count FROM Connection WHERE WhomID = :iuid";
    $state= $database->prepare($quer);
    $state->bindValue(':iuid', $_SESSION['user_id']);
    $resul = $state->execute();
    $rowfl = $resul -> fetchArray();

?>
    <br><br>
    <?php echo $rowfl ['count']; ?> Followers | <?php echo $rowfo['count']; ?> Following 
    <br><br>
    <?php 
    $qu = "SELECT PostID, UserID, content, createdAt FROM Posts WHERE UserID = :uid ORDER BY createdAt DESC";
    $st = $database->prepare($qu);
    $st->bindValue(':uid', $_SESSION['user_id']);
    $rer = $st->execute();

    while ($re = $rer->fetchArray()) {
        //var_dump($row);
        $que = "SELECT UserName FROM Users WHERE UserID = :udi";
        $sta = $database->prepare($que);
        $sta->bindValue(':udi', $row['UserID']);
        $res = $sta->execute();
        $ro = $res -> fetchArray();
        echo 'Post ID: ' . $re['PostID'] . ' Posted By: ' . $ro['UserName'] . ' On : ' . $re['createdAt'];
        echo "<br>";
        echo $re['content'];
        echo "<br><br><br>";
    }
    
    ?>
</body>

</html>