<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $db = new SQLite3('./Database/gwitter.db');
        session_start();
        
        $username = $_SESSION['username'];
    ?>
    <h2>Welcome to Gweetpage</h2>
    <form action="gweet.php" method="post">
        <input type="hidden" name ="username" >
        <textarea name="gweet" id="gweetpost" cols="20" rows="30" placeholder="Whats the Gweet"></textarea>
        <button type="submit">POST</button>
    </form>
    <?php
            //database connection session start();
            $query = "SELECT * FROM gweets";
            $result = $db->query($query);
            while($row = $result->fetchArray(SQLITE3_ASSOC)){
                echo "<h3>{$row['username']}</h3>";
                echo "<p>{$row['gweet']}</p>";
                echo "<hr>";
            }

    ?>
</body>
</html>