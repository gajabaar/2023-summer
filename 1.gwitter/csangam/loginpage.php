<?php
session_start();

if (isset($_SESSION['username'])) {
  header("Location: homepage.php"); 
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gwitter</title>
  <link rel="stylesheet" href="./styleslogin.css">
</head>

<body>
  <div class="auth-page">
    <div class="auth-container">
      <h1>Login</h1>
      <form action="login.php" method="post">
        <input type="text" name="unameemail" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button class="auth-button" type="submit">Login</button>
        <?php
         $errormessage=$_GET['var'];
         if (isset($errormessage)) { 
          echo "<p class='error-message'>$errormessage</p>";
        };
        ?>
      </form>
    </div>
  </div>
</body>

</html>