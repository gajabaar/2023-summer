<?php
// Connect to the database
$db = new SQLite3('gwitter.db');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form input values
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Debug: print the form input values
  echo "Username: " . $username . "<br>";
  echo "Password: " . $password . "<br>";

  // Check if the username and password match
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $db->query($query);
$row = $result->fetchArray();



var_dump($row);

if ($row) {
  session_start();
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $row['email']; // retrieve the email field from the row
  $_SESSION['id'] = $row['id'];

  header("Location: ./home.php");
  exit();
} else {
  echo "Invalid username or password";
  die();
}
}

// Debug: print the post_max_size and max_input_vars
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_input_vars: " . ini_get('max_input_vars') . "<br>";

// Debug: print the query and result
echo "Query: " . $query . "<br>";
echo "Result: ";
var_dump($result->fetchArray());

var_dump($_POST);
?>