<?php
require('toppart.php')
?>
    <?php
        if(isset($_GET['username'])){
        $username = $_GET['username'];
        $query1 ="SELECT * FROM followed_by WHERE username = '$username'";
        $query2 ="SELECT * FROM followed_by WHERE followed_by = '$username'";
        $result1 = $db->query($query1);
        $result2 = $db->query($query2);
        ?>
        <div class="f-container">
        <div class="followers">
        <ul>
        <h3><?php echo $username;?>'s followers:</h3>
        <?php
        while($row = $result1->fetchArray(SQLITE3_ASSOC)){
        ?> 
        <li><p><?php echo $row['followed_by'] ?></p></li>
        <?php   
        }?>
         </ul>
</div> 
<div class="followed">

        <h3><?php echo $username;?>'s follows:</h3>
        <ul>
        <?php
        while($row = $result2->fetchArray(SQLITE3_ASSOC)){
        ?> 
        <li><p><?php echo $row['username'] ?></p></li>
        <?php   
        }?>
         </ul>
</div>
</div> 
<h2 class="yourpost"><?php echo $username;?>'s post:</h2>
<?php
        $query = "SELECT * FROM gweets WHERE username = '$username'";
            $result = $db->query($query);
            while($row = $result->fetchArray(SQLITE3_ASSOC)){
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
        }
        else{
            header('location:index.php');
        }
        ?>
</body>
</html>