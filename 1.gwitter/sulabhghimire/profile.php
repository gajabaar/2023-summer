<?php 
    session_start();
    include "db_conn.php";


    $curr_user = $_SESSION['user_id'];
    if (!isset($_SESSION['user_id'])) {
        // The user is already logged in, redirect them to the home page
        header('Location: index.php');
        exit;
    }

    $uid = $_GET['val'];
    $query = "SELECT * FROM Users WHERE UserID = :uid";
    $statement = $database->prepare($query);
    $statement->bindValue(':uid', $uid);
    $results = $statement->execute();
    $row = $results -> fetchArray();
    
?>
<html>
<head>
    <title>Gwitter - HomePage</title>
    <style>
    body
    {
        margin: 0;
        padding: 0;
        background-color:#6abadeba;
        font-family: 'Arial';
    }
    .main{
            width: infinity;
            overflow: hidden;
            margin: 200 0 0 200px;
            padding: 80px;
            background: #23463f;
            border-radius: 15px ;
            align : center;
            color : white;
    }
    #homeid{
        text-align: left;
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
    #Box{
        border: none;
        border-radius: 3px;
        padding-left: 8px;

    }
    #helper{
        font-size : 20px;
    }
    #content {
        color : white;
    }
    </style>
</head>
<body>
    <h2 id="homeid">Gwitter
        <br>
        <div id="helper">
        <a href="logout.php">Logout</a>
        Hello,<a href="profile.php?val=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username'] ?>
        </a>
    </div>
    </h2>
    
    <div class="main">
    
    <?php if (isset($_GET['error'])) { ?>
        <div id="error">
        <p class="error"><?php echo $_GET['error']; ?></p>
        </div>
        <?php } ?>
    <?php
        if ($_SESSION['user_id']==$uid){ ?>
            <a href="updateprofile.php">Update Profile</a> <br>
    <?php    } else { 
            $url = "connection.php?who=$curr_user&whom=$uid";

            $new_query = "SELECT * FROM Connection WHERE WhoID = :who AND WhomID = :whom";
            $new_statement = $database->prepare($new_query);
            $new_statement->bindValue(':who', $_SESSION['user_id']);
            $new_statement->bindValue(':whom', $uid);
            $new_results = $new_statement->execute();

            $new_row = $new_results -> fetchArray();

            if(empty($new_row)) {
    ?>
            <a href="<?php echo $url?>">Follow</a> <br>
    <?php        
        }
        else{
            $url = "unfollow.php?who=$curr_user&whom=$uid";
    ?>
        <a href="<?php echo $url?>">Unfollow</a> <br>
    <?php } }?>    
    
    Name : <?php echo $row['FullName']?> <br>
    User Name : <?php echo $row['UserName']?> <br>
    Bio : <?php echo $row['Bio']?>
    <?php
    $quer= "SELECT COUNT(*) AS count FROM Connection WHERE WhoID = :iuid";
    $state= $database->prepare($quer);
    $state->bindValue(':iuid', $uid);
    $resul = $state->execute();
    $rowfo = $resul -> fetchArray();

    $quer= "SELECT COUNT(*) AS count FROM Connection WHERE WhomID = :iuid";
    $state= $database->prepare($quer);
    $state->bindValue(':iuid', $uid);
    $resul = $state->execute();
    $rowfl = $resul -> fetchArray();

?>
    <br><br>
    <a href="followers.php?val=<?php echo $uid; ?>"> <?php echo $rowfl ['count']; ?> Followers</a> | 
    <a href="following.php?val=<?php echo $uid; ?>"><?php echo $rowfo['count']; ?>  Following</a> 
    <br><br>
    <h3 style="color : white;">Tweets From This Person</h3>
    <div id="content">

<br><br>
    <?php 
    $qu = "SELECT PostID, UserID, content, createdAt FROM Posts WHERE UserID = :uid ORDER BY createdAt DESC";
    $st = $database->prepare($qu);
    $st->bindValue(':uid', $uid);
    $rer = $st->execute();

    while ($re = $rer->fetchArray()) {
        //var_dump($row);
        $que = "SELECT UserName FROM Users WHERE UserID = :udi";
        $sta = $database->prepare($que);
        $sta->bindValue(':udi', $row['UserID']);
        $res = $sta->execute();
        $ro = $res -> fetchArray();
        echo ' Posted By: ' . $ro['UserName'] . '<br>';
        echo ' On : ' . $re['createdAt'];
        echo "<br>";
        echo $re['content'];
        echo "<br><br>";
    }
    
    ?>
</div>
</div>
</body>
</html>