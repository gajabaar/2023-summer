<?php
// SQLite database file path
$dbFile = 'gwitter.db';

// Create a new SQLite3 database connection
$db = new SQLite3($dbFile);

// Check if the signup form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using MD5
    $hashedPassword = md5($password);

    // Insert the user data into the database
    $query = "INSERT INTO userlogin (firstname, lastname, username, password) VALUES (:firstname,:lastname, :username, :password)";
    $statement = $db->prepare($query);

    // Check if the statement preparation was successful
    if (!$statement) {
        die('Error during statement preparation: ' . $db->lastErrorMsg());
    }

    // Bind the parameter values
    $statement->bindParam(':firstname', $firstname);
    $statement->bindParam(':lastname', $lastname);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);

    // Execute the statement
    $result = $statement->execute();

    // Check if the execution was successful
    if ($result) {
        echo 'Signup successful! Please login.';
        echo '<a href="/index.php">Login</a>';
    } else {
        die('Error during statement execution: ' . $db->lastErrorMsg());
    }
}
?>
