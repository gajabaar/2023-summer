<?php
session_start();

include "db_conn.php";

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: homepage.php');
    exit();
}

// Check if the user has submitted the login form
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Users WHERE UserName = :username AND Password = :password";
    $statement = $database->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $results = $statement->execute();

    $row = $results -> fetchArray();

    if (empty($row)) {
        header("Location: index.php?error=Wrong password or email.");
        exit();
    } else {
        $user_id = $row['UserID'];
        $user_name = $row['UserName'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $user_name;
        header("Location: homepage.php");
        exit();
    }
}
if (empty($_POST['username'])) {

    header("Location: index.php?error=User Name is required");

    exit();

}
if(empty($_POST['password'])){

    header("Location: index.php?error=Password is required");

    exit();

}
?>