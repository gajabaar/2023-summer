<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        //check for empty
        if(empty($username) || empty($password) || empty($confirmPassword)){
            $error = "Empty Entry";
        }
        //password mismatch
        elseif($password !== $confirmPassword){
            $error = "Password Mismatch";
        }else{
            $database = new SQLite3("./database/gwitter.db");
            $loweredUsername = strtolower($username);
            $query = $database->prepare("select * from users where username = :username");
            $query->bindValue(':username',$loweredUsername);
            $result = $query->execute();
    
            // Check if a matching user was found
            if ($result->fetchArray()) {
                // Username exists
                $error = "Username already exists.";
            }else{
                $q = $database->prepare("INSERT into users (username,password) values (:username,:password)");
                $q->bindValue(':username',$loweredUsername);
                $q->bindValue(':password',password_hash($password,PASSWORD_BCRYPT));
                $q->execute();

                header("Location: login.php");

            }
        }
        
        
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    

<section class="vh-100" style="background-color: #fff;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
       
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                <div class="text-danger text-center weight-bold" >
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                 </div>
    

                <form id="register-form" class="mx-1 mx-md-4" action = "/register.php" method="post" onsubmit="return registerUser(event)">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="username">Username</label>
                      <input type="text" id="username" name="username" class="form-control" required />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="password">Password</label>
                      <input type="password" minlegth = "8" name="password" id="password" class="form-control" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <label class="form-label" for="confirmPassword">Confirm your password</label>
                      <input type="password" name = "confirmPassword" minlength="8" id="confirmPassword" class="form-control" required/>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit"  id="register-btn" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        function registerUser(event){
            event.preventDefault();
            console.log("clicked");
            const password =document.getElementById('password').value
            const confirmPassword =document.getElementById('confirmPassword').value
           if(password === confirmPassword){
                event.target.submit();
           }else{
            console.log("Password do not match");
           }
        }
    </script>
    
</body>
</html>
