<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Establish a connection to the SQLite database
    $db = new SQLite3('../database/gwitter.db');

    // Check for errors during database connection
    if (!$db) {
        die("Database connection error: " . $db->lastErrorMsg());
    }

    // Prepare the query to select user information
    $query = $db->prepare('SELECT * FROM users WHERE username = :username ');
    $query->bindParam(':username', $username, SQLITE3_TEXT);

    // $query->bindParam(':password', $password, SQLITE3_TEXT);

    $results = $query->execute();

    $row = $results->fetchArray(SQLITE3_ASSOC);


    if ($row) {
    if (password_verify($password, $row['password'])){
        session_start();
        $_SESSION["username"] = $row["username"];
        $_SESSION["userID"] = $row["userID"];
        header("Location: ../Profile/profile.php");
        exit();
    }
    else{
        header("Location: ../index.php");
    }
    } else {
        header("Location: index.php?result=Invalid username or password");
        exit();
    }
}
?>
