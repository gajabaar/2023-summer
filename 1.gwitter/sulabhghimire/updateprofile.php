<!DOCTYPE html>
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
        $uname = $_POST['password'];
        $pass = $_POST['fullname'];
        $st->bindValue(':password', $uname);
        $st->bindValue(':fullname', $pass);
        $st->bindValue(':bio', $_POST['bio']);
        $st->bindValue(':user_id', $_SESSION['user_id']);

        if($st->execute()){
            header('Location: profile.php');
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
<html>

<head>
    <title> Gwitter </title>
</head>
<body>
    <h2>Update Your Profile : </h2>
    <form action="updateprofile.php" method="post">
        Full Name : 
        <input type="text" name="fullname" value="<?php echo $row['FullName']?>">
        <br><br>
        User Name : <?php echo $_SESSION['username']?>
        <br><br>
        Bio : <br>
        <textarea type="text" name="bio"><?php echo $row['Bio']?></textarea>
        <br><br>
        Password :
        <input type="password" name="password" placeholder="Password" value="<?php echo $row['Password']?>">
        <br><br>
        Retype Password :
        <input type="password" name="password2" placeholder="Password" value="<?php echo $row['Password']?>">
        <br><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>