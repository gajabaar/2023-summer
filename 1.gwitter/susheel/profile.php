<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter</title>
</head>

<body>

    <?php
    $username = $_GET["username"];
    $password = $_GET["password"];
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

    if ($userExist) {
        echo "User $username successfully login";
    } else {
        echo "Username and password doesn't exist";
    }

    ?>
</body>

</html>