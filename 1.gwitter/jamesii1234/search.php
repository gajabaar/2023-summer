<?php
// Retrieve the search query from the URL parameter
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
$query = $_GET['query'];
// echo $query;
// Perform the search query against your database (modify the query according to your table structure)
// Example: Fetch users whose usernames or bios contain the search query
$pdo = new PDO('sqlite:gwitter.db');
$users = $pdo->query("SELECT * FROM userlogin WHERE username LIKE '%$query%' OR firstname Or lastname LIKE '%$query%'")->fetchAll(PDO::FETCH_ASSOC);

// Display the search results
echo "<h2>Search Results</h2>";

if (count($users) > 0) {
    foreach ($users as $user) {
        echo "<div>";
        echo "<h3>" . $user['username'] . "</h3>";
        echo "<h3>" . $user['firstname']." ".$user['lastname'] . "</h3>";
        echo "<p> " . $user['bio'] . "</p>";
        // echo "<a href='profile.php?user_id=" . $user['id'] . "'>View Profile</a>";
        // echo "<a href='profile.php?username=" . $row['username'] . "'>View Profile</a>";
        echo "<a href='profile.php?username=" . $user['username'] . "'>View Profile</a>";

        echo "</div>";
    }
} else {
    echo "No results found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>

        <a href="logout.php">Logout</a>
        <a href="home.php">Home</a>
    </div>

</body>
</html>