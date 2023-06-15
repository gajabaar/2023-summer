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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gwitter</title>
    <link rel="stylesheet" href="./styleslogin.css">
  </head>
  <body>
    <div class="auth-page">
    <div class="auth-container">
      <h1>Signup</h1>
        <form action="signup.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="auth-button">Signup</button>
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
