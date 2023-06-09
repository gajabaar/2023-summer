<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}
include "db_conn.php";

if (isset($_POST['cont'])) {
    if(strlen($_POST['cont']) == 0){
        header('Location: homepage.php?error=Empty post.');
        exit();
    }
    $query1 = "INSERT INTO Posts (UserID, content) VALUES ( :uid , :cont )";
    $statement1 = $database->prepare($query1);
    $statement1->bindValue(':uid', $_SESSION['user_id']);
    $statement1->bindValue(':cont', $_POST['cont']);
    $statement1->execute();
    header('Location: homepage.php');
    exit;
}

$query = "SELECT DISTINCT PostID, UserID, content, createdAt  FROM Posts INNER JOIN Connection ON 
        Posts.UserID = Connection.WhomID  WHERE WhoID = :uid OR Posts.UserID =:uid ORDER BY 
        PostID DESC";
$statement = $database->prepare($query);
$statement->bindValue(':uid', $_SESSION['user_id']);
$results = $statement->execute();


?>
<html>
<a href="logout.php">Logout</a>
Hello,<a href="profile.php?val=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username'] ?></a>
<br><br>
<h2>Add Something New : </h2>
<form action="homepage.php" method="post">
<textarea type="text" name="cont"></textarea>
<br><br>
        <input type="submit" value="Update">
</form>
<h2>All posts  : </h2>
<?php
    while ($row = $results->fetchArray()) {
        //var_dump($row);
        $query = "SELECT UserName FROM Users WHERE UserID = :udi";
        $statement = $database->prepare($query);
        $statement->bindValue(':udi', $row['UserID']);
        $resu = $statement->execute();
        $rows = $resu -> fetchArray();

        echo 'Post ID: ' . $row['PostID'] . ' Posted By: ' . $rows['UserName'] . ' On : ' . $row['createdAt'];
        echo "<br>";
        echo $row['content'];
        echo "<br><br><br>";
    }
?>

</html>