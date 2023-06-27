<?php 
session_start();
include "db_conn.php";

if (!isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: index.php');
    exit;
}

if (isset($_POST['fullname']) && isset($_POST['bio']) && isset($_POST['password']) && isset($_POST['password2'])) {
    
    if($_POST['password'] == $_POST['password2']){

        if(strlen($_POST['password']) < 8){
            header('Location: updateprofile.php?error=Password must be 8 characters long.');
            exit();
        }

        $que = "UPDATE Users SET Password = :password, Bio = :bio, FullName = :fullname WHERE UserID = :user_id";
        $st = $database->prepare($que);
        $plaintext_password = $_POST['password'];
        $hash = password_hash($plaintext_password, PASSWORD_DEFAULT);
        $fullname = $_POST['fullname'];
        $st->bindValue(':password', $hash);
        $st->bindValue(':fullname', $fullname);
        $st->bindValue(':bio', $_POST['bio']);
        $st->bindValue(':user_id', $_SESSION['user_id']);

        $send_this = $_SESSION['user_id'];

        if($st->execute()){
            header("Location: profile.php?val=$send_this");
        }
        else{
            $msg=$sql->errorInfo(); // if any error is there it will be posted
            header('Location: updateprofile.php?error=$msg');
        }


        
    }else{
        header('Location: updateprofile.php?error=Both password are different.');
        exit();
    }
}

    $query = "SELECT * FROM Users WHERE UserID = :uid";
    $statement = $database->prepare($query);
    $statement->bindValue(':uid', $_SESSION['user_id']);
    $results = $statement->execute();
    $row = $results -> fetchArray();

?>
<!DOCTYPE html>

<html>
<head>
    <title>Gwitter - Update Profile</title>
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
    #Box{
        border: none;
        border-radius: 3px;
        padding-left: 8px;

    }
    </style>
</head>
<body>
    <h2> Gwitter - Login Page</h2><br>
    <div class="login">
    
    <?php if (isset($_GET['error'])) { ?>
        <div id="error">
        <p class="error"><?php echo $_GET['error']; ?></p>
        </div>
        <?php } ?>
    
    <form id="login" method="Post" action="updateprofile.php">
        <label><b>User Name
        </b>
        </label>
        <input type="text" id="Uname" value="<?php echo $row['UserName']?>" disabled>
        <br><br>
        
        <label><b>Full Name
        </b>
        </label>
        <input type="text" id="Uname" placeholder="FullNAme" name="fullname" value="<?php echo $row['FullName']?>">
        <br><br>
        <label><b> Bio
        </b>
        </label>
        <textarea type="text" name="bio" rows="10" cols="50" id="Box"><?php echo $row['Bio']?></textarea>
        <br><br>
        <label><b>New Password
        </b>
        </label>
        <input type="Password" id="Pass" placeholder="Password" name="password">
        <br><br>
        <label><b>Re-Type Password
        </b>
        </label>
        <input type="Password" id="Pass" placeholder="Retype New Password" name="password2">
        <br><br>
        <input type="submit" id="log" value="Update">
        <br><br>
    </span>
    </form>
</div>
</body>
</html>
