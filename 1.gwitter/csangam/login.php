<?php
session_start();
include 'db_connect.php'; 


$usernameOrEmail = $_POST['unameemail'];
$password = $_POST['password'];

// Determine if the posted value is a username or an email
$isEmail = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL);

// Prepare the query with placeholders
if ($isEmail) {
    $query = "SELECT * FROM user WHERE email = :email AND password = :password";
} else {
    $query = "SELECT * FROM user WHERE user_name = :username AND password = :password";
}



$stmt = $db->prepare($query);

if ($isEmail) {
    $stmt->bindValue(':email', $usernameOrEmail);
} else {
    $stmt->bindValue(':username', $usernameOrEmail);
}
$stmt->bindValue(':password', $password);

$result = $stmt->execute();

if ($result->fetchArray()) {
    session_start(); 
    if ($isEmail) {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $usernameOrEmail);
        $result=$stmt->execute();
        $row = $result->fetchArray();
        $_SESSION['username'] = $row['user_name']; 
        $_SESSION['user_id'] = $row['user_id'];
    } else {
        $query = "SELECT * FROM user WHERE user_name = :username";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $usernameOrEmail);
        $result=$stmt->execute();
        $row = $result->fetchArray();
        $_SESSION['username'] = $row['user_name']; 
        $_SESSION['user_id'] = $row['user_id'];
    }
    header("Location: homepage.php");
    exit();
} else {
    $errorMessage = "Invalid username or password";
    $encodedVariable = urlencode($errorMessage);
    $errorlogin = "loginpage.php?var=" . $encodedVariable;
    header("Location: $errorlogin");
    exit();
};

$db->close();
?>