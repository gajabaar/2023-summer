<?php
session_start();

include "db_conn.php";

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: homepage.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['fullname']) 
    && isset($_POST['bio'])) {

    if ($_POST['password']==$_POST['password2']){

        $query = "SELECT * FROM Users WHERE UserName = :username";
        $statement = $database->prepare($query);
        $statement->bindValue(':username', $_POST['username']);
        $results = $statement->execute();

        $row = $results -> fetchArray();

        if(empty($row)){
            $plaintext_password = $_POST['password'];
            $hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
            $query = "INSERT INTO Users (UserName, Password, FullName, Bio) VALUES ( :username, :password, :fullname, :bio)";
            $statement = $database->prepare($query);
            $statement->bindValue(':username', $_POST['username']);
            $statement->bindValue(':password', $_POST['password']);
            $statement->bindValue(':fullname', $_POST['fullname']);
            $statement->bindValue(':bio', $_POST['bio']);
            $statement->execute();
            header('Location: homepage.php');
            exit;
        }else{
            $msg = "User with username already exists.";
            header("Location: signup.php?error=$msg");
            exit();
        }
        
    }else{
        $msg = "Two passwords don't match.";
        header("Location: signup.php?error=$msg");
        exit();
    }
}

?>