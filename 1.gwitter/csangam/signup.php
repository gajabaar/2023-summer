<?php
include 'db_connect.php'; 

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$checkQuery = "SELECT * FROM user WHERE user_name = :username OR email = :email";
$checkStmt = $db->prepare($checkQuery);
$checkStmt->bindValue(':username', $username);
$checkStmt->bindValue(':email', $email);
$checkResult = $checkStmt->execute();

if ($checkResult->fetchArray()) {
    $errorMessage = "User already exits";
    $encodedVariable = urlencode($errorMessage);
    $errorsignup = "signuppage.php?var=" . $encodedVariable;
    header("Location: $errorsignup");
    exit();
} else {
    $insertQuery = "INSERT INTO user (name, user_name, email, password) VALUES (:name, :username, :email, :password)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindValue(':name', $name);
    $insertStmt->bindValue(':username', $username);
    $insertStmt->bindValue(':email', $email);
    $insertStmt->bindValue(':password', $password);
    $insertResult = $insertStmt->execute();

    if ($insertResult) {
        $successMessage = "You can login as new user";
        $encodedVariable = urlencode($successMessage);
        $successsignup = "loginpage.php?var=" . $encodedVariable;
        header("Location: $successsignup"); 
        exit();
    } else {
        $errorMessage = "error occured during signup";
        $encodedVariable = urlencode($errorMessage);
        $errorsignup = "signuppage.php?var=" . $encodedVariable;
        header("Location: $errorsignup");
        exit();
    }
}

$db->close();
?>
