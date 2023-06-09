<!DOCTYPE html>
<?php 
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}

$query= "SELECT UserName
        FROM Users
        WHERE UserID IN (
            SELECT WhomID
            FROM Connection
            WHERE WhoID = :uid
        )";
$statement = $database->prepare($query);
$statement->bindValue(':uid', $_SESSION['user_id']);
$results = $statement->execute();

?>
<body>
    <h2>Following</h2>
    <?php
while ($row = $results->fetchArray()) {
    echo $row['UserName'];
    echo "<br>";
}
?>
</body>
</html>