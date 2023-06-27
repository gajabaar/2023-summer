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
    
    <form id="login" method="Post" action="login.php">
        <label><b>User Name
        </b>
        </label>
        <input type="text" id="Uname" placeholder="Username" name="username">
        <br><br>
        <label><b>Password
        </b>
        </label>
        <input type="Password" id="Pass" placeholder="Password" name="password">
        <br><br>
        <input type="submit" id="log" value="Log In Here">
        <br><br>
        <span>
        Don't have ID ? <a href="signup.php">Sign Up</a>
    </span>
    </form>
</div>
</body>
</html>
