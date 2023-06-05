<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
    <title> Gwitter </title>
</head>

<body>
    Welcome to Gwitter, Dear <?php echo $_SESSION["username"]; ?>!
</body>

</html>