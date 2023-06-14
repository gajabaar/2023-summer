<?php
include("./db_connect.php");
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  header('Location: login.php');
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $gweet = $_POST['gweet'];
  $username = $_SESSION['username'];

  $res = $db->query("SELECT userID from user WHERE username= '$username'");
  $userId = $res->fetchArray()['userID'];
  $query = $db->prepare("INSERT into tweet (gweet,userID) values ('$gweet','$userId')");
  $query->bindParam(':gweet', $gweet);
  $query->bindParam(':userID', $userId);
  $rs = $query->execute();
}
$result = $db->query("Select * from tweet join user on tweet.userID=user.userID");

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
  <nav class="navbar navbar-expand-lg navbar-dark  px-3 mb-4">
    <a class="container navbar-brand fw-bold fs-2 text-primary" href="/index.php">Gwitter</a>
    <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link mx-2 text-dark" href="/profile.php"><?php echo $_SESSION['username']; ?></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link btn-danger rounded-3" href="/logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </nav>

  <section class="m-8 container d-flex flex-column justify-content-center align-items-center">
    <form class="form-inline" method="POST" action="index.php">

      <div class="form-group mb-2 d-flex align-items-center justify-content-center">
        <div class="form-outline mb-2">
          <input type="text" name="gweet" class="form-control form-control-lg" placeholder="Tweet something ! using gwitter" />
        </div>
        <button type="submit" class="btn btn-primary mb-2 mx-1">Gweet</button>
      </div>
    </form>
    <?php
    while ($row = $result->fetchArray()) {
    ?>
      <div class="card container-sm mb-4">

        <div class=" w-25 h-25 d-flex align-items-center">
          <a href="/profile.php?id=<?php echo $row['userID']; ?>"><img class="rounded-circle" alt="avatar1" src="https://img.icons8.com/?size=60&id=23244&format=png" /></a>
          <h4 class="mx-2"><?php echo $row["username"] ?></4>
        </div>

        <div class="card-body" id="<?php echo $row['id']; ?>">
          <p class="card-text text-dark"><?php echo $row["gweet"] ?></p>
          <a href="#" class="btn btn-primary">Reply</a>
        </div>
      </div>
    <?php
    }
    ?>

  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>