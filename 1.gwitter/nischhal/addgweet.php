<?php
echo $_POST['username'];

    if(isset($_POST['gweet'])){
        $db = new SQLite3('./database/users.db'); 
        $username = $_POST['username'];
        $gweet = $_POST['gweet'];
        $query = "INSERT INTO gweets (username, gweet) VALUES ('$username', '$gweet')";
        $result = $db->query($query);}
    //     if($result)
    //     {
    //     header("location:homepage.php");
    //     }
    //     else 
    //     {
    //     echo"<h2>Gweet couldn't be posted</h2>";
    //     }
    // }
    // else{
    //     echo"<h2>No gweet content</h2>";
    // }
?>