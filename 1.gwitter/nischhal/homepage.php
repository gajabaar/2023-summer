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
        $db = new SQLite3('./database/users.db');
        session_start();
        
        $username = $_SESSION['username'];
    ?>
    <h2>Welcome to homepage</h2>
    <form action="addgweet.php" method="post">
        <input type="hidden" name ="username" value= "<?php echo $username?>" >
        <textarea name="gweet" id="gweetpost" cols="30" rows="10" placeholder="Share your thoughts"></textarea>
        <button type="submit">POST</button>
    </form>
    <?php
            // SQLite3 database connectionsession_start();
            $query = "SELECT * FROM gweets";
            $result = $db->query($query);
            while($row = $result->fetchArray(SQLITE3_ASSOC)){
                echo "<h3>{$row['username']}</h3>";
                echo "<p>{$row['gweet']}</p>";
                echo "<hr>";
            }
            // You can include additional HTML and styling for the post feed here
    ?>
</body>
</html>