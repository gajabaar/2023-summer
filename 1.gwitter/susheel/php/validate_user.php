<?php
function validateUser($username, $password)
{
    $userExist = false;

    $database = new SQLite3('./gwitter.sqlite3');
    $results = $database->query('SELECT NAME,PASSWORD FROM USERS');
    while ($row = $results->fetchArray()) {
        if ($row['NAME'] == $username) {
            if ($row["PASSWORD"] == $password) {
                $userExist = true;
                break;
            }
        }
    }

    return $userExist;
}
