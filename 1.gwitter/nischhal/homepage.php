<?php
require('toppart.php');
?>
<?php
//database connection and getting messege from session.

if (isset($_SESSION['login_success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['login_success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php  } ?>


<h3 class="heading1">Welcome to homepage, <?php echo $username;?>!</h3>
<div class="profile">
    <div class="profile-controls">
        <a href="sessionuser_profile.php"><img src="https://picsum.photos/id/44/50" alt="pp"></a>
        <a href="sessionuser_profile.php"><h4 class="py-2 px-2">@<?php echo $username;?></h4></a>
    </div>
    <form action="addgweet.php" method="post">
        <div class="addgweet">
            <input type="hidden" name="username" value="<?php echo $username ?>">
            <textarea name="gweet" id="gweetpost" cols="40" rows="5" placeholder="Share your thoughts"></textarea>
            <button type="submit" class="btn btn-outline-dark my-2">POST</button>
        </div>
    </form>
</div>
<hr>
<div class="followsuggest">
    <p>Click here to follow someone:</p>
    <a href="follow_suggest.php" class="btn btn-outline-dark"> >>Follow someone<< </a>
    <p class="">You need to follow someone to get post.</p>
</div>

<?php
$follow_query = "SELECT * FROM followed_by WHERE followed_by = :username";
$follow_statement = $db->prepare($follow_query);
$follow_statement->bindValue(':username', $username, SQLITE3_TEXT);
$follow_result = $follow_statement->execute();
$follow_users = array();
while ($follow_row = $follow_result->fetchArray(SQLITE3_ASSOC)) {
    $follow_users[] = $follow_row['username'];
}

array_push($follow_users,$username); //pushes own username at last of array.

$follow_users_str = implode("','",$follow_users);

if(!empty($follow_users_str)){
$query = "SELECT * FROM gweets WHERE username IN ('$follow_users_str') ORDER BY id DESC";
$result = $db->query($query);
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
 ?>
<div class="post-card">
    <div class="user-controls">
        <a href=""><img src="https://picsum.photos/id/<?php echo $row['id'];?>/50" alt="pp"></a>
        <?php $link_url = 'user_profile.php?username=' . $row['username']?>
        <h4><a href="<?php echo $link_url;?>">@<?php echo $row['username']; ?></a></h4>
    </div>
    <p><?php echo $row['gweet']; ?></p>
    <hr>
</div>    
<?php
}}
else{
    echo "<h2>Follow someone to get posts.</h2>";
}
// You can include additional HTML and styling for the post feed here
?>
</body>

</html>