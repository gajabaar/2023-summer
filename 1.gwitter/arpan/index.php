<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter</title>
    <link rel="stylesheet" href="./css_files/index.css">
</head>

<body>
    <h1 class="login">Login</h1>
    <div class="form">
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="error-message">
                <?php
                if (isset($_GET['result'])) {
                    echo htmlspecialchars($_GET['result']);
                }
                ?>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
    <div id="login-result"></div>
    <p class="notauser">Not a user? <a href="signup.php">Sign up</a></p>
</body>

</html>
