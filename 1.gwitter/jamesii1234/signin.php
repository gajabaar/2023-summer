<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$hashedPassword = md5($password);
$db = new SQLite3('gwitter.db');
$results = $db->query('SELECT * FROM userlogin');

while ($row = $results->fetchArray()) {
    if ($row["username"] == $username && $row["password"] == $hashedPassword) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: /home.php");
        exit;
    }
}

echo "User not found!<br/>";
die();
?>
