<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: home.php"); // Redirect to the home page or any other desired page
    exit;
}?>
<html>

<head>
    <title> Gwitter </title>
    <link rel="stylesheet" href="./css/index.css">
    <script defer src="./js/index.js"></script>
</head>

<body>
    <div class="container">

        <div style="padding: 10px;">
            Don't miss what's happenning!
        </div>
        <div>People on Gwitter are first to know</div>
        <button class="loginform">
            Login
        </button>
        <div class="logincore" style="display:none">
            Login
            <form action="signin.php" method="post"   autocomplete="off">
                <input type="text" name="username"style="margin: 10px;" placeholder="username" /><br>
                <input type="password"  name="password"style="margin: 10px;" placeholder="password" /><br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <div>
            New to twitter?
        </div>
        <button class="signupform">
            Signup
        </button>
        <div class="signupcore" style="display: none;">
    Signup
    <form action="signup.php" method="post">
        <input type="text" name="firstname" style="margin: 10px;" placeholder="First Name"><br>
        <input type="text" name="lastname" style="margin: 10px;" placeholder="Last Name"><br>
        <input type="text" name="username" style="margin: 10px;" placeholder="username" /><br>
        <input type="password" name="password" style="margin: 10px;" placeholder="password" /><br>
        <input type="submit" value="Submit">
    </form>
</div>

    </div>

</body>

</html>
