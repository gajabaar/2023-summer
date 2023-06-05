<html>

<head>
    <title> Gwitter </title>
</head>

<body>
    Welcome to Gwitter! <br/>
    <form method="POST">
        <input type="text" name="username" placeholder="username"/>
        <input type="text" name="password" placeholder="password"/>
        <input type="submit" value="Submit">
    </form>
</body>

</html>

<?php

    
$username = $_POST['username'];
$password = $_POST['password'];


$UserExists = 0;
$db = new SQLite3('database/gwitter.db');

$results = $db->query('SELECT * FROM Users');
while ($row = $results->fetchArray()) {
   if ($row['Username'] == $username && $row['Password'] == $password) {
        session_start();
        $_SESSION["username"] = $username;
        $UserExists = 1;
        header("Location: /profile.php");
        break;
    } 
}
if ($UserExists != 1){
    
        echo "User not found! <br/>";
        die();

}
?>
