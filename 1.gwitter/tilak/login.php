<?php
include("./db_connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $db->prepare("SELECT * FROM user WHERE username = '$username'");
    $query->bindParam(':username', $username);

    $result = $query->execute();
    if ($user = $result->fetchArray()) {
        echo $user['password'];
        if ($password == $user['password']) {     
            header("Location: index.php");
            session_start();
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            exit();
        }
        else {
            echo "Invalid password";
        }
    } else {

        $error = "Invalid username or password";
    }
}

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>gwitter</title>
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="login.php" method="POST">
                                <h3 class="mb-5">Login to gwitter</h3>

                                <div class="form-outline mb-2">
                                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" />
                                </div>

                                <div class="form-outline mb-2">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" />
                                </div>

                                <Button type="submit" name="submit">Login </Button>
                                <p>Haven an account? <a href="signup.php">Create an account</a></p>
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