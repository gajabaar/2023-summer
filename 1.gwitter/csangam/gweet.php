<?php
session_start();

include 'db_connect.php'; 

$gweet = $_POST['gweet'];
$userid = $_SESSION['user_id'];


    $insertQuery = "INSERT INTO gweet (content,creator) VALUES (:gweet, :userid)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindValue(':gweet', $gweet);
    $insertStmt->bindValue(':userid', $userid);
    $insertResult = $insertStmt->execute();

    if ($insertResult) {
        $successMessage = "successfully gweeted";
        $encodedVariable = urlencode($successMessage);
        $successgweet = "profile.php?var=" . $encodedVariable;
        header("Location: $successgweet"); 
        exit();
    } else {
        $errorMessage = "error occured during gweeting";
        $encodedVariable = urlencode($errorMessage);
        $errorgweet = "profile.php?var=" . $encodedVariable;
        header("Location: $errorgweet");
        exit();
    }


$db->close();
?>
