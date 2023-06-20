<?php
function validateUser($username, $password)
{


    $database = new SQLite3('../gwitter.sqlite3');

    $query = $database->prepare('SELECT * FROM USERS WHERE NAME = :username and PASSWORD = :password');
    $query->bindValue(':username', $username, SQLITE3_TEXT);
    $query->bindValue(':password', $password, SQLITE3_TEXT);

    $results = $query->execute();

    $row = $results->fetchArray(SQLITE3_ASSOC);
    
    if ($row) {
        return true;
    }
    return false;
}
