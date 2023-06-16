
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <?php
    session_start();
        if(isset($_SESSION['error_message'])){
            echo "<p style='color: red;'>{$_SESSION['error_message']}</p>";
            unset($_SESSION['error_message']);
        }
    ?>
    <form action="login.php" method="post">
        <input type="text" name="userid" id="" placeholder="User name">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
