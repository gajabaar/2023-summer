<?php
    // $db = new SQLite3('./database/users.db'); 
    // if($db){
    //     echo "Connection successfull";
    // }
    // $query = "INSERT INTO gweets('username', 'gweet') VALUES('sasuke','Itaachiiii!')";
    // $result = $db->query($query);
    // echo $result;
    // if($result)
    //     {
    //     echo "pOSTING successfull";
    //     }
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_POST['gweet'])){
            $db = new SQLite3('./database/users.sqlite3'); 
            $username = $_POST['username'];
            $gweet = $_POST['gweet'];
            $query = "INSERT INTO gweets (username, gweet) VALUES ('$username', '$gweet')";
            $result = $db->query($query);
            if($result)
            {
                header("location:homepage.php");
            }
            else 
            {
                echo exec('whoami');
                echo "<h2>Gweet couldn't be posted. Error:  </h2>". $db->lastErrorMsg();
            }
        }
        else{
            echo "No gweet content!!";
        }
    }
    else{
        header('location:index.php');
    }
?>