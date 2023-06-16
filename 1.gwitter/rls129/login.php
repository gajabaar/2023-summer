<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

$database = new SQLite3("./gwitter.db");

$stmt = "SELECT * FROM Users WHERE username='$username';";
$results = $database->querySingle($stmt, true);

if ($results) {
    $salt = getenv("SALT");
    if (password_verify($password.$salt, $results["password"]) == false) {
        echo "Something Went Wrong";
        die();
    }
} else {
    echo "Something Went Wrong";
    die();
}

$_SESSION["username"] = $username;
header("Location: gweets.php");
?>
