<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: homepage.php');
    exit;
}

?>

<html>
<head>
    <title>Gwitter - Sign Up</title>
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
    <h2> Gwitter - Sign Up</h2><br>
    <div class="login">
    
    <?php if (isset($_GET['error'])) { ?>
        <div id="error">
        <p class="error"><?php echo $_GET['error']; ?></p>
        </div>
        <?php } ?>
    
    <form id="login" method="Post" action="signup_logic.php">
        <label><b>Full Name
        </b>
        <input type="text" name="fullname" placeholder="Full Name" id="Uname" required>
        <br><br>
        <label><b>User Name
        </b>
        </label>
        <input type="text" id="Uname" placeholder="Username" name="username" required>
        <br><br>
        <label><b>Password
        </b>
        </label>
        <input type="Password" id="Pass" placeholder="Password" name="password">
        <br><br>
        <label><b>Retype Password
        </b>
        </label>
        <input type="Password" id="Pass" placeholder="Retype Same Password" name="password2">
        <br><br>
        <label><b>Bio For Your Profile
        </b>
     </label>
        <textarea type="text" name="bio" rows="10" cols="50" placeholder="Enter your Bio" id="Box" required></textarea>
        <br><br>
        <input type="submit" id="log" value="Sign Up">
        <br><br>
        <span>
        Already have an Id <a href="index.php">Log In</a>
    </span>
    </form>
</div>
</body>
</html>