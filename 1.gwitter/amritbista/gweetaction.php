<?php
echo $_POST['username'];

    if(isset($_POST['gweet'])){
        $db = new SQLite3('./Database/gwitter.db'); 
        $username = $_POST['username'];
        $gweet = $_POST['gweet'];
        $query = "INSERT INTO gweets (username, gweet) VALUES ('$username', '$gweet')";
        $result = $db->query($query);}

?>