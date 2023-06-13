

<?php
    
$username = $_POST['username'];
$password = $_POST['password'];
$cPassword = $_POST['cPassword'];

if (empty($username) || empty($password) || empty($cPassword)){
    header("Location: ../index.php?error=emptyFields");
    exit();
} elseif (!preg_match("/^[a-zA-Z0-9]*/", $username)){
    header("Location: ../index.php?error=invalidUsername");
    exit();
} elseif ($password !== $cPassword){
    header("Location: ../index.php?error=PasswordDoesn'tMatch");
    exit();
} elseif ( !(strlen($password) >= 8)){
    header("Location: ../index.php?error=PasswordLengthMustBeGreaterThan8");
    exit();
}

$db = new SQLite3("../database/gwitter.db");

// checking if username already exists
$query = "SELECT username FROM users WHERE username = :username";

$stmt = $db->prepare($query);
$stmt->bindValue(':username', $username);

$result = $stmt->execute();

while ($row = $result->fetchArray()) {
   if ($row['username'] == $username) {
    header("Location: ../index.php?error=UserAlreadyExists");
        exit();
    } 
}

// Inerting into database
$query = "INSERT INTO users ('username', 'password') VALUES (:username, :password)";

$stmt = $db->prepare($query);
$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);

$result = $stmt->execute();

// Check if the query was successful
if ($result) {
    header("Location: ../index.php?msg=UserCreatedSuccessfully");
    exit();
} else {
    echo "Failed to insert username.";
    die();
}


?>
