<?php
//include 'database/connection.php';
    
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];


if (empty($username) || empty($password)){
    header("Location: index.php?error=emptyFields");
    exit();
} elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)){
    header("Location: index.php?error=invalidUsername");
    exit();
}
$UserExists = 0;

$db = new SQLite3("database/gwitter.db");

$results = $db->query('SELECT * FROM users');

while ($row = $results->fetchArray()) {
   if ($row['username'] == $username && $row['password'] == $password) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION['userId'] = $row['userId'];
        $UserExists = 1;
        header("Location: /home.php");
        break;
    } 
}

if ($UserExists != 1){
    echo "Username or password invalid!";
    exit();
}

?>