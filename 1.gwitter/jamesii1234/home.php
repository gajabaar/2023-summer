<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div class="container">
        <div id="sidebar">
            <ul>
                <li>
                    <img src="./3106773.png" class="pic" alt=""><a href="profile.php?username=<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></a>

                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
                <li>
                    <form action="search.php" method="get">
                        <input type="text" name="id" placeholder="Search User ID">
                        <input type="submit" value=">">
                    </form>
                </li>
                <li>
                </li>
            </ul>
        </div>

        <div class="box">
            <form class="gweet-form" action="gweet.php" method="post">
                <input type="text" placeholder="What's happening?" name="gweet">
                <br>
                <input type="submit" value="Tweet">
            </form>
        </div>
    </div>
</body>

</html>