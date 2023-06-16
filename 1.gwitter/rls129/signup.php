<?php
session_start();

if (!isset($_POST["name"])) {
    die();
}
if (!isset($_POST["username"])) {
    die();
}
if (!isset($_POST["password"])) {
    die();
}
if (!isset($_POST["bdate"])) {
    die();
}


$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$date = $_POST["bdate"];

$database = new SQLite3("./gwitter.db");
$salt = getenv("SALT");
$password_hash = password_hash($password.$salt, PASSWORD_DEFAULT);

$stmt = "INSERT INTO Users(name, username, password, birthday) VALUES('$name', '$username', '$password_hash', '$date');";

$something = $database->exec($stmt);
if ($something) {
    $_SESSION["username"] = $username;
    header("Location: gweets.php");
} else {
    echo "Something isnt Right!";
    echo "<br>";
    echo "<a href='index.php'><button>Goto Home</button></a>";
}
?>
