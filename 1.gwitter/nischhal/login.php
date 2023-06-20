<?php
$db = new SQLite3('./database/users.sqlite3'); 
// if(!$db){
//     die("Database connection error: " . $db->lastErrorMsg());
// }
// else{
//     echo"connection succcess";
// }


if(isset($_POST['userid']) && isset($_POST['password'])){
    $username = $_POST['userid'];
    $passkey = md5($_POST['password']);
    $query = "SELECT * FROM users WHERE username = '$username' AND passkey = '$passkey'";
    $result = $db->query($query);
    if($row = $result->fetchArray(SQLITE3_ASSOC)){
        session_start();
        $_SESSION['username'] = $username ;
        $_SESSION['login_success'] = "Login successfull!";
        header("location:follow_suggest.php");
        exit;
    }
    else{
        session_start();
        $_SESSION['error_message'] = "Invalid username or password!";
        // Redirect back to the login page
        header("location:index.php");
        exit;
    }
}
# header('location:index.html');
?>

