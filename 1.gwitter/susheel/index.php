<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Gwitter</title>
</head>

<body>
    <?php
    include("php/validate_user.php");
    /*
    Check whether the php SESSION variable is present or not

    If present
        Add the content of "php/profile.php"
    else
        Add the content of "php/login.php"
    */

    $username = $_POST["username"];
    $password = $_POST["password"];
    $userExist;

    if ($username && $password) {
        $userExist = validateUser($username, $password);
    }
    
    if ($userExist == true) {
        session_start();
        $_SESSION['username'] = $username;
    }

    if (isset($_SESSION)) {
        include("php/profile.php");
    } else {
        include("php/login.php");
    }
    ?>

</body>

</html>