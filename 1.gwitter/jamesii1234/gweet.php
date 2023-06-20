<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $gweet = $_POST['gweet'];
    // echo $username;
    $db = new SQLite3('gwitter.db');

    // Prepare the INSERT statement
    $statement = $db->prepare("INSERT INTO gweet (username, gweet) VALUES (:username, :gweet)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':gweet', $gweet);

    // Execute the statement
    $result = $statement->execute();

    if ($result) {
        header("Location:home.php");
        // echo 'Gweet posted successfully!';
    } else {
        echo 'Failed to post the gweet.';
    }
}


?>
