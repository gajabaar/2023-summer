<?php 
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // User is not authenticated, redirect to the login page or display an authentication error message
    header('Location: login.php');
    exit;
}

$db = new SQLite3("./database/gwitter.db");
$result = $db->query("Select * from gweets join users on gweets.user_id=users.id");
// while($row = $result->fetchArray()){
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
  <a class="navbar-brand fw-bold fs-2 text-primary" href="/index.php">Gwitter</a>
  <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn-success rounded-3 mx-2" href="/profile.php">Profile</a>
      </li> 
      <li class="nav-item active">
        <a class="nav-link btn-danger rounded-3" href="/logout.php">Logout</a>
      </li> 

    </ul>
  </div>
</nav>
<div class="d-flex justify-content-center">
<div class="d-flex mt-3 flex-column">
<form class="form-inline">
  
  <div class="form-group mb-2 d-flex">
    <input type="text" name="gweet" class="form-control" id="gweet" placeholder="Gweet something!">
    <button type="submit" class="btn btn-primary mb-2 mx-1">Gweet</button>
  </div>
</form>

<?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetchArray())
                {
            ?>
    <div class="card p-2 my-1">
        <div class="d-flex justify-content-between">
            <div class="card-title fw-bold text-dark"><?php echo $rows['username'] ?></div>
            <a href="" class="btn-outline text-success">Follow</a>
        </div>
        <div class=""><?php echo $rows['gweet'] ?></div>

    </div>
    <?php 
        }
        ?>
</div>


</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>