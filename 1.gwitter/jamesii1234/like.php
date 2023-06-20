<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo 'error';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gweetId = $_POST['gweet_id'];

    $dbFile = 'gwitter.db';
    $db = new SQLite3($dbFile);
    $query = "UPDATE gweet SET likes = likes + 1 WHERE id = :gweet_id";
    $statement = $db->prepare($query);

    if ($statement) {
        $statement->bindValue(':gweet_id', $gweetId, SQLITE3_INTEGER);
        $result = $statement->execute();

        if ($result) {
            $_SESSION['liked_gweets'][$gweetId] = true;
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
