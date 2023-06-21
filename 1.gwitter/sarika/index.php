<!DOCTYPE html>
<html>
<head>
    <title>Login and Signup</title>
    <link rel="stylesheet" href="./Styling/style.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div id="login-form">
        <!-- <h2>Login</h2> -->
        <form method="post" action="./Authentication/login.php">
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="#" onclick="toggleForms()">Sign up</a></p>
    </div>
    <div id="signup-form" class="hidden">
        <!-- <h2>Signup</h2> -->
        <form method="post" action="./Authentication/signup.php">
            
            <label>Username:</label>
            <input type="text" name="username" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Signup">
        </form>
        <p>Already have an account? <a href="#" onclick="toggleForms()">Login</a></p>
    </div>
    <script>
        function toggleForms() {
            var loginForm = document.getElementById("login-form");
            var signupForm = document.getElementById("signup-form");
            loginForm.classList.toggle("hidden");
            signupForm.classList.toggle("hidden");
        }
    </script>
</body>
</html>