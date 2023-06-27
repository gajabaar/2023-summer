<?php
if (isset($_POST['userid']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['confirm-password'])){
    $db = new SQLite3('./database/users.sqlite3');
    $username = $_POST['userid'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirmpass = md5($_POST['confirm-password']);
    $query = "INSERT INTO users(username,passkey,email) VALUES('$username','$password','$email')";
    if($password == $confirmpass){
        $result = $db->query($query);
        if($result){
            session_start();
            $_SESSION['username'] = $username ;
            $_SESSION['login_success'] = "Login successfull!" ;
            header('location:follow_suggest.php');
            exit;
        }
        else{
            session_start();
            $_SESSION['signup_failure'] = "Try again!" ;
            header('location:signup_page.php');
            exit;
        }
    }
    else{
        session_start();
        $_SESSION['signup_failure'] = "Password doesn't match up.";
        header('location:signup_page.php');
        exit;
    }
}
?>