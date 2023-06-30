<?php
$db = new SQLite3('./Database/gwitter.db'); 

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);
    if($row = $result->fetchArray(SQLITE3_ASSOC)){
        session_start();
        $_SESSION['username'] = $username ;
        header("location:homepage.php");
        exit;
    }
    else{
        session_start();
        $_SESSION['error_message'] = "Invalid username or password!";
        // Return to the login page
        header("location:index.php");
    }
}
?>
