<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}
include "db_conn.php";

if (isset($_POST['cont'])) {
    if(strlen($_POST['cont']) == 0){
        header('Location: homepage.php?error=Empty post.');
        exit();
    }
    $query1 = "INSERT INTO Posts (UserID, content) VALUES ( :uid , :cont )";
    $statement1 = $database->prepare($query1);
    $statement1->bindValue(':uid', $_SESSION['user_id']);
    $statement1->bindValue(':cont', $_POST['cont']);
    $statement1->execute();
    header('Location: homepage.php');
    exit;
}

$query = "SELECT DISTINCT PostID, UserID, content, createdAt  FROM Posts INNER JOIN Connection ON 
        Posts.UserID = Connection.WhomID  WHERE WhoID = :uid OR Posts.UserID =:uid ORDER BY 
        PostID DESC";
$statement = $database->prepare($query);
$statement->bindValue(':uid', $_SESSION['user_id']);
$results = $statement->execute();


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
            width: 800px;
            overflow: hidden;
            margin: 20 0 0 200px;
            padding: 80px;
            background: #23463f;
            border-radius: 15px ;
            align : center;
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
    <h2 id="homeid"><a href="homepage.php">Gwitter</a>
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
    
    <form id="login" method="Post" action="homepage.php">
        <textarea type="text" name="cont" rows="10" cols="100" placeholder="What's On Your Mind" id="Box" required></textarea>
        <br><br>
        <input type="submit" id="log" value="Tweet">
    </form>

    <h3 style="color : white;">Tweets From People You Follow</h3>
    <div id="content">
    <?php
    while ($row = $results->fetchArray()) {
        //var_dump($row);
        $query = "SELECT UserName FROM Users WHERE UserID = :udi";
        $statement = $database->prepare($query);
        $statement->bindValue(':udi', $row['UserID']);
        $resu = $statement->execute();
        $rows = $resu -> fetchArray();   
        echo "By : ". $rows['UserName']. "<br>";
        echo "On : ". $row['createdAt']. "<br>";
        echo $row['content'];
        echo "<br><br>
        <br>";
    }
    
?>
</div>
</div>
</body>
</html>