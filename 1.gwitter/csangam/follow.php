<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['username'])) {
  header("Location: loginpage.php"); 
  exit();
}

$userId = $_SESSION['user_id'];
$followedUserId = $_POST['followid'];

// Check if the user is already following the given user
$query = "SELECT * FROM follower WHERE user_id = :followedUserId AND follower_id = :userId ";
$statement = $db->prepare($query);
$statement->bindValue(':userId', $userId);
$statement->bindValue(':followedUserId', $followedUserId);
$result = $statement->execute();

if ($result->fetchArray()) {
  // User is already following, redirect with an error message
  $errorMessage = "You are already following this user.";
  $encodedVariable = urlencode($errorMessage);
  $redirectUrl = "list.php?var=" . $encodedVariable;
  header("Location: $redirectUrl");
  exit();
}

// Insert a new follower record
$insertQuery = "INSERT INTO follower (user_id, follower_id) VALUES ( :followedUserId, :userId)";
$insertStatement = $db->prepare($insertQuery);
$insertStatement->bindValue(':userId', $userId);
$insertStatement->bindValue(':followedUserId', $followedUserId);
$insertResult = $insertStatement->execute();

if ($insertResult) {
  $successMessage = "You are now following the user.";
  $encodedVariable = urlencode($successMessage);
  $redirectUrl = "list.php?var=" . $encodedVariable;
  header("Location: $redirectUrl");
  exit();
} else {
  $errorMessage = "Error occurred while trying to follow the user.";
  $encodedVariable = urlencode($errorMessage);
  $redirectUrl = "list.php?var=" . $encodedVariable;
  header("Location: $redirectUrl");
  exit();
}

$db->close();
?>
