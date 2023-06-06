<html>


<body>

    <?php
    include("utils/validate_user.php");


    echo $_SERVER['REQUEST_METHOD'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST["username"];
        $password = $_POST["password"];


        $userExist = validateUser($username, $password);

        echo $userExist;
        if (true) {
            session_start();
            echo $username;

            $_SESSION['username'] = $username;

            header("Location: http://localhost:4000/php/profile.php");
            die();
        } else {
            header("Location: http://localhost:4000/index.html");
        }
    } else {
        header("Location: http://localhost:4000/index.html");
        die();
    }
    ?>
</body>

</html>