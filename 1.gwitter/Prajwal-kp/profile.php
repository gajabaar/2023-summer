<?php
session_start();

// Connect to the database using PDO
$db = new PDO('sqlite:gwitter.db');

// Get the user ID of the currently logged-in user
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gwitter | Profile</title>
    <link rel="stylesheet" href="profile.css">
  </head>
  <body>
    <header>
      <h1>Gwitter</h1>
      <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="profile-header">
        <div class="profile-avatar">
          <img src="https://placehold.it/100x100" alt="">
        </div>
        <div class="profile-info">
          <h2 class="profile-username">Welcome <?php echo $username; ?>!</h2>
          <p class="profile-bio"></p>
          <div class="profile-stats">
            <div class="profile-stat">
              <div class="profile-stat-label">Tweets</div>
              <div class="profile-stat-value">
                <?php
                // Query the database to retrieve the number of tweets for the logged-in user
                $query = "SELECT COUNT(*) FROM tweets INNER JOIN users ON tweets.user_id = users.id WHERE users.username = '$username'";
                $result = $db->query($query);
                $count = $result->fetchColumn();
                echo $count;
                ?>
              </div>
            </div>
            <div class="profile-stat">
              <div class="profile-stat-label">Following</div>

              <div class="profile-stat-value">
  <?php
  // Query the database to retrieve the number of followings for the logged-in user
  $query = "SELECT COUNT(*) FROM followings INNER JOIN users ON followings.follower_id = users.id WHERE users.username = '$username'";
  $result = $db->query($query);
  $count = $result->fetchColumn();
  echo $count;
  ?>
</div>
            </div>
            <div class="profile-stat">
              <div class="profile-stat-label">Followers</div>
<div class="profile-stat-value">
  <?php
  // Query the database to retrieve the number of followers for the logged-in user
  $query = "SELECT COUNT(*) FROM followers INNER JOIN users ON followers.follower_id = users.id WHERE users.username = '$username'";
  $result = $db->query($query);
  $count = $result->fetchColumn();
  echo $count;
  ?>
</div>
            </div>
          </div>
        </div>
      </div>
      <div class="tweets">
        <?php
        // Query the database to retrieve the tweets for the logged-in user
        $query = "SELECT * FROM tweets INNER JOIN users ON tweets.user_id = users.id WHERE users.username = '$username'";
        $result = $db->query($query);

        // Loop over the result set and display the tweets
        while ($row = $result->fetch()) {
          $content = $row['content'];
          $created_at = $row['created_at'];
          echo "<p>$content - $created_at</p>";
        }
        ?>
      </div>
    </main>
    <footer>
      <p>&copy; 2023 Gwitter</p>
    </footer>
  </body>
</html>