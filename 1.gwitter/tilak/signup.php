<?php
include("./db_connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    //check for empty
    if (empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        $error = "Fill all the empty.";
    } else {
        $loweredUsername = strtolower($username);
        $query = $db->prepare("select * from user where username = :username");
        $query->bindValue(':username', $loweredUsername);
        $result = $query->execute();

        if ($result->fetchArray()) {
            $error = "Username already exists.";
        } else {
            $q = $db->prepare("INSERT into user (firstName,lastName,username,password) values ('$firstname','$lastname','$username','$password')");
            $q->bindValue(':firstName', $firstname);
            $q->bindValue(':lastName', $lastname);
            $q->bindValue(':username', $loweredUsername);
            $q->bindValue(':password',$password);
            $result = $q->execute();
            if ($result) {
                echo 'Registration successful. Welcome, ' . $username . '!';
                header("Location: login.php");
            } else {
                echo 'Registration failed. Please try again.';
            }

           
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>gwitter | Register</title>
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="signup.php" method="POST">
                                <h3 class="mb-5">Register to gwitter</h3>
                                <div class="form-outline mb-2">
                                    <input type="text" id="firstname" name="firstname" class="form-control form-control-lg" placeholder="Firstname" />
                                </div>
                                <div class="form-outline mb-2">
                                    <input type="text" id="lastname" name="lastname" class="form-control form-control-lg" placeholder="Lastname" />
                                </div>
                                <div class="form-outline mb-2">
                                    <input type="text"  name="username" class="form-control form-control-lg" placeholder="Username" />
                                </div>

                                <div class="form-outline mb-2">
                                    <input type="password"  name="password" class="form-control form-control-lg" placeholder="Password" />
                                </div>

                                <Button type="submit" name="submit">Register </Button>
                                <p>already an account? <a href="login.php">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>