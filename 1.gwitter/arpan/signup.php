<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: profile.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db = new SQLite3('./database/gwitter.db');

    $query = $db->prepare('SELECT * FROM User WHERE username = :username');
    $query->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $query->execute();

    if ($result->fetchArray()) {
        $error = "Username already taken.";
    } else {
        $query = $db->prepare('INSERT INTO User (username, password) VALUES (:username, :password)');
        $query->bindValue(':username', $username, SQLITE3_TEXT);
        $query->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $result = $query->execute();

        if ($result) {
            header("Location: index.php?result=" . urlencode("Registration successful. Please login."));
            exit;
        } else {
            $error = "Error: " . $db->lastErrorMsg();
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
    <link rel="stylesheet" href="./css_files/signup.css">
</head>

<body>
    <h1 class="signup">Sign up</h1>

    <div class="form">
        <form action="signup.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="error-message">
                <?php if (isset($error)) { ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php } ?>
            </div>
            <input type="submit" value="Sign up">
        </form>
    </div>
    <p class="isauser">Already have an account? <a href="index.php">Log in</a></p>
</body>

</html>
