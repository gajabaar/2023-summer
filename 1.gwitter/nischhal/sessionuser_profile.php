<?php
require('toppart.php')
?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $followers_query = "SELECT * FROM followed_by WHERE username = '$username'";
    $followedby_query = "SELECT * FROM followed_by WHERE followed_by = '$username'";
    $result1 = $db->query($followers_query);
    $result2 = $db->query($followedby_query);
?>
<div class="f-container">
<div class="followers">
    <h3>Your followers:</h3>
    <ul>
    <?php
    while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    ?>
    <li> <p><?php echo $row['followed_by'] ?></p></li>
    <?php
    } ?>
    </ul>
</div>    
<div class="followed">
    <h3>You follow:</h3>
    <ul>
    <?php
    while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
    ?>
        <li><p><?php echo $row['username'] ?></p></li>
    <?php
    }?>
    </ul>
</div>
</div> 
<h2 class="yourpost">Your post:</h2>
<?php   
    $query = "SELECT * FROM gweets WHERE username = '$username'";
    $result = $db->query($query);
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    ?>
        <div class="post-card">
            <div class="user-controls">
                <a href=""><img src="https://picsum.photos/id/<?php echo $row['id']; ?>/50" alt="pp"></a>
                <?php $link_url = 'user_profile.php?username=' . $row['username'] ?>
                <h4><a href="<?php echo $link_url; ?>">@<?php echo $row['username']; ?></a></h4>
            </div>
            <p><?php echo $row['gweet']; ?></p>
            <hr>
        </div>
<?php
    }
} else {
    header('location:index.php');
}
?>
</body>

</html>