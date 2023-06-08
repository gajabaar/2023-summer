<?php 
    session_start();
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        header('Location: login.php');
        exit;
    }
    $db = new SQLite3("./database/gwitter.db");
    $id = 0;
    $name = $_SESSION['username'];
    $currentUserId = $db->query("Select id from users where username='$name'")->fetchArray()['id'];

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $name = $db->query("SELECT username from users where id='$id'")->fetchArray()['username'];

        
    }else{
        $id = $currentUserId;

    }
    $result = $db->query("Select * from gweets join users on gweets.user_id = users.id where user_id = '$id'");

    $result_following = $db->query("SELECT * FROM followers where followed_by='$currentUserId'");
    $data = array();
    while ($row = $result_following->fetchArray()){
        $data[] = (int)$row['uid'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $followingId = $_POST['id'];
        if(in_array($followingId,$data)){
            $query = $db->prepare("DELETE FROM followers where uid = :uid and followed_by = :follower");
            
            $query->bindValue(':uid',$followingId);
            $query->bindValue(':follower',$currentUserId);
            $query->execute();
            

        }else{
            $query = $db->prepare("INSERT INTO followers(uid,followed_by) values (:uid, :follower)");
            $query->bindValue(':uid',$followingId);
            $query->bindValue(':follower',$currentUserId);
            $query->execute();
        }
        header("Location: /profile.php?id=".$followingId);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 ">
  <a class="navbar-brand fw-bold fs-2 text-primary" href="/index.php">Gwitter</a>
  <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn-success rounded-3 mx-2" href="/profile.php"><?php echo $_SESSION['username']; ?></a>
      </li> 
      <li class="nav-item active">
        <a class="nav-link btn-danger rounded-3" href="/logout.php">Logout</a>
      </li> 

    </ul>
  </div>
</nav>
<div class="d-flex p-2 justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
            <div class="mt-3">
                <h4><?php echo $name ?></h4>

                <?php if ($id !== $currentUserId) { 
                    if (in_array($id,$data) == false){
                    ?>
                    <form action="/profile.php" method="post">
                        <input type="hidden" name="id" value = "<?php echo $id ?>"/>
                        <button class="btn btn-primary">Follow</button>
                    </form>
                <?php }else{ ?>
                    <form action="/profile.php" method="post">
                    <input type="hidden" name="id" value = "<?php echo $id ?>"/>
                        <button class="btn btn-danger">Unfollow</button>
                    </form>
                <?php }}?>

            </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column mx-2" >
    <?php
        // LOOP TILL END OF DATA
        while($rows=$result->fetchArray())
        {
    ?>
    <div class="card p-2 my-1">
        <div class="d-flex justify-content-between">
            <a href="/profile.php?id=<?php echo $rows['user_id']; ?>" class="card-title fw-bold text-primary"><?php echo $rows['username'] ?></a>
        </div>
        <div class="" id="<?php echo $rows['id']; ?>"><?php echo htmlspecialchars($rows['gweet']) ?></div>

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