<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: profile.php");
    exit;
}

if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 5) {
    $currentTime = time();
    $lastFailedTime = isset($_SESSION['last_failed_time']) ? $_SESSION['last_failed_time'] : 0;
    $timeDiff = $currentTime - $lastFailedTime;

    if ($timeDiff <= 60) {
        header("Location: index.php?result=" . urlencode("Too many failed login attempts. Please try again after 60 seconds."));
        exit;
    } else {
        $_SESSION['failed_attempts'] = 0;
    }
}

$db = new SQLite3('./database/gwitter.db');

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';

$query = $db->prepare('SELECT * FROM User WHERE username = ?');
$query->bindValue(1, $username, SQLITE3_TEXT);
$result = $query->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

if ($user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = $user["user_id"];
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['failed_attempts'] = isset($_SESSION['failed_attempts']) ? $_SESSION['failed_attempts'] + 1 : 1;
        $_SESSION['last_failed_time'] = time();

        header("Location: index.php?result=" . urlencode("Invalid username or password."));
        exit;
    }
} else {
    header("Location: index.php?result=" . urlencode("Invalid username or password."));
    exit;    
}
