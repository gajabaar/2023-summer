<?php
include("./db_connect.php");
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}

$id = 0;
$name = $_SESSION['username'];
$currentUserId = $db->query("Select userID from user where username='$name'")->fetchArray()['userID'];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $name = $db->query("SELECT username from user where userID='$id'")->fetchArray()['username'];
} else {
    $id = $currentUserId;
}
// echo $id;
// get all users 
$q = $db->prepare("SELECT * FROM user WHERE userID='$id'");
$userDetail = $q->execute();

// get all gweets of respective id
$stmt = $db->prepare("Select * from tweet where userID = '$id'");
$gweets = $stmt->execute();
$number_of_gweets = 0;
while ($row = $gweets->fetchArray()) {
    $number_of_gweets++;
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
    <nav class="navbar navbar-expand-lg navbar-dark  px-3">
        <a class="container navbar-brand fw-bold fs-2 text-primary" href="/index.php">Gwitter</a>
        <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link mx-2 text-dark" href="/profile.php"><?php echo $name ?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link btn-danger rounded-3" href="/logout.php">Logout</a>
                </li>

            </ul>
        </div>
    </nav>

    <section class="gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="https://img.icons8.com/?size=360&id=23244&format=png" alt="profile image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                                <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                                    Follow
                                </button>
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <?php
                                while ($row = $userDetail->fetchArray()) {
                                ?>
                                    <h5><?php echo "{$row['firstName']} "?><span><?php echo $row['lastName'] ?></span></h5>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="p-4 text-black" style="background-color: #f8f9fa;">
                            <div class="d-flex justify-content-end text-center py-1">
                                <div>
                                    <p class="mb-1 h5"><?php echo $number_of_gweets ?></p>
                                    <p class="small text-muted mb-0">Gweets</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-1 h5">0</p>
                                    <p class="small text-muted mb-0">Followers</p>
                                </div>
                                <div>
                                    <p class="mb-1 h5">0</p>
                                    <p class="small text-muted mb-0">Following</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <!-- <div class="mb-5">
                                <p class="lead fw-normal mb-1">About</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <p class="font-italic mb-1">Web Developer</p>
                                    <p class="font-italic mb-1">Lives in New York</p>
                                    <p class="font-italic mb-0">Photographer</p>
                                </div>
                            </div> -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">All gweets</p>
                            </div>
                            <div class="">
                                <?php
                                while ($row = $gweets->fetchArray()) {
                                ?>
                                    <div class="card container-sm mb-4">
                                        <div class="card-body" id="<?php echo $row['id']; ?>">
                                            <p class="card-text text-dark"><?php echo $row["gweet"] ?></p>
                                            <a href="#" class="btn btn-primary">Reply</a>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>