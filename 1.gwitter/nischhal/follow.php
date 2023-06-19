<?php
    if(isset($_POST['follow']) && isset($_POST['follower'])){
        $db = new SQLite3('./database/users.sqlite3');
        $username = $_POST['follow'];
        $follower = $_POST['follower'];
        $redirect = $_POST['page'];
        $query = "INSERT INTO followed_by(username,followed_by) VALUES('$username','$follower')";
        $result = $db->query($query);
        if($result){
            session_start();
            $_SESSION['follow_success']= "Followed successfully.";
            if($redirect =="0"){
            header('location:follow_suggest.php');}
            elseif($redirect =="1"){
            header('location:homepage.php');
            }
        }
        else{
            echo "Follow unsuccessfull!". $db->lastErrorMsg();
        }
    }
?>