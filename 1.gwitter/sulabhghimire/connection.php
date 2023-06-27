<?php 
    session_start();
    include "db_conn.php";


    $curr_user = $_SESSION['user_id'];
    if (!isset($_SESSION['user_id'])) {
        // The user is already logged in, redirect them to the home page
        header('Location: index.php');
        exit;
    }

    $whoid = $_GET['who'];
    $whomid = $_GET['whom'];

    $query = "SELECT * FROM Connection WHERE WhoID = :who AND WhomID = :whom";
    $statement = $database->prepare($query);
    $statement->bindValue(':who', $whoid);
    $statement->bindValue(':whom', $whomid);
    $results = $statement->execute();
    $row = $results -> fetchArray();

    if (empty($row)){
        $query = "INSERT INTO Connection (WhoID, WhomID) VALUES (:who,  :whom)";
        $statement = $database->prepare($query);
        $statement->bindValue(':who', $whoid);
        $statement->bindValue(':whom', $whomid);
        $results = $statement->execute();

        header("Location: profile.php?val=$whomid");
        exit;

    }else{
        header("Location: profile.php?val=$whomid");
    }




?>