<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // The user is already logged in, redirect them to the home page
    header('Location: homepage.php');
    exit;
}

?>
<h1>Login</h1>
<?php if (isset($_GET['error'])) { ?>

<p class="error"><?php echo $_GET['error']; ?></p>

<?php } ?>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login">
</form>