<?php 
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}

$uid = $_GET['val'];


$query= "SELECT UserName
        FROM Users
        WHERE UserID IN (
            SELECT WhomID
            FROM Connection
            WHERE WhoID = :uid
        )";
$statement = $database->prepare($query);
$statement->bindValue(':uid', $uid);
$results = $statement->execute();

?>

<html>
<head>
    <title>Gwitter - Login Form</title>
    <style>
    body
    {
        margin: 0;
        padding: 0;
        background-color:#6abadeba;
        font-family: 'Arial';
    }
    .login{
            width: 382px;
            overflow: hidden;
            margin: auto;
            margin: 20 0 0 450px;
            padding: 80px;
            background: #23463f;
            border-radius: 15px ;

    }
    h2{
        text-align: center;
        color: #277582;
        padding: 20px;
    }
    label{
        color: #08ffd1;
        font-size: 17px;
    }
    #Uname{
        width: 300px;
        height: 30px;
        border: none;
        border-radius: 3px;
        padding-left: 8px;
    }
    #Pass{
        width: 300px;
        height: 30px;
        border: none;
        border-radius: 3px;
        padding-left: 8px;

    }
    #log{
        width: 300px;
        height: 30px;
        border: none;
        border-radius: 17px;
        padding-left: 7px;
        color: blue;


    }
    span{
        color: white;
        font-size: 17px;
    }
    a{
        background-color: none;
        color: white;
    }
    #error{
        background-color : white;
        color : red;
        height : 30px;
        text-align : center;
        margin-top : 10px;
    }
    #page{
        color : white;
    }
    </style>
</head>
<body>
    <h2> Following</h2><br>
    <div class="login" id="page">
    <?php
while ($row = $results->fetchArray()) {
    echo $row['UserName'];
    echo "<br>";
}
?>
</div>
</body>
</html>
