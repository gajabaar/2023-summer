<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];

        $database = new SQLite3("./database/gwitter.db");
    
        // Prepare the SQL statement to retrieve the user with matching credentials
        $query = $database->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindValue(':username', $username);
        
        $result = $query->execute();
        if ($user = $result->fetchArray()) {
            // Successful login, redirect to a protected page
            if(password_verify($password,$user['password'])){
                header("Location: index.php");
                session_start();
                $_SESSION['authenticated']=true;
                $_SESSION['username']=$username;
                exit();
            }
            
        } else {
            // Invalid username or password
            $error = "Invalid username or password";
        }
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gwitter - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <h1 class="h-1 text-center mt-3">Login</h1>
  <div class="text-danger text-center weight-bold" >
  <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
  </div>
    

    <form class="container p-3 w-25" method="post" action="/login.php">
  <!-- Email input -->
  <div class="form-outline mb-4">
      <label class="form-label" for="username">Username</label>
      <input name="username" type="text" id="username" class="form-control" required/>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
      <label class="form-label" for="password">Password</label>
      <input name="password" type="password" id="password" class="form-control" required />
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="/register.php">Register</a></p>
    
  </div>
</form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</body>
</html>