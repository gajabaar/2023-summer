<?php
$db = new SQLite3('./database/users.db'); 
// if(!$db){
//     die("Database connection error: " . $db->lastErrorMsg());
// }
// else{
//     echo"connection succcess";
// }


if(isset($_POST['userid']) && isset($_POST['password'])){
    $username = $_POST['userid'];
    $passkey = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND passkey = '$passkey'";
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
        // Redirect back to the login page
        header("location:index.php");
    }
}
# header('location:index.html');
?>

