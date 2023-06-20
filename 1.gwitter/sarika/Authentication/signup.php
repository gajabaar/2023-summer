<?php
session_start();
if (isset($_SESSION["username"])){
    header("Location: ../Profile/profile.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!(strlen($password) > 6) || !(strlen($password) < 20)){
        echo '<script>alert("Invalid length of password.")</script>';
        exit();
    }
    $db = new SQLite3('../database/gwitter.db');

    // check if username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->querySingle($query); // execute query and returns a single result

    if ($result) {
        //  if username is already taken , display error
        $error = "Username already taken.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // insert the new user into the database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
        $result = $db->exec($query); // The exec() method will return the number of affected rows, which should be 1 if the insertion was successful.

        if ($result) {
            // if registration successful, redirect to login page
            header("Location: ../index.php");
            exit;
        } else {
            // if registration failed, display an error message
            $error = "Error: " . $db->lastErrorMsg();
            // The lastErrorMsg() method returns a string that describes the last error that occurred on the database connection. 
        }
    }
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter - Sign up</title>
</head>
<body>
    <h1>Sign up</h1>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form action="signup.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Sign up">
    </form>

    <p>Already have an account? <a href="index.php">Log in</a></p>
</body>
</html>