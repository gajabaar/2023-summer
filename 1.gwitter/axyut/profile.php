
<?php session_start(); 
require_once 'includes/header.php';
$db = new SQLite3("database/gwitter.db");
$userId = $_SESSION["userId"];
$username = $_SESSION["username"];
?>

<div class="profile-container">
    <table>
        
        <tr>
            <td>
                <?php
                     echo "<h3>Gweets</h3>";
                    $query = "SELECT * FROM posts WHERE userId= :userId";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':userId', $userId);
                    
                    $result = $stmt->execute();
                    while ($row = $result->fetchArray()) {
                        $title = $row['title'];
                        $username = $row['username'];
                        $postId = $row['postId'];
                        echo "<label>".$username." 
                        <form action='delete_edit_comment.php' method='POST'> 
                            <input type='hidden' name='userId' value='$userId'>
                            <input type='hidden' name='postId' value='$postId'>
                            <input type='hidden' name='username' value='$username'>
                            <textarea class='edit-textarea' name='title'>".$title."</textarea><br/> 
                            
                            <button class='input-button' style='float:right;' name='deleteClick' type='submit'>
                                Delete
                            </button> 
                            <button class='input-button' style='float:right;' name='editClick' type='submit'>
                                Edit
                            </button> 
                            <input class='comment-input' name='comment' placeholder='My comment' /> 
                            <button style='float:right;' class='input-button' name='addCommentClick'>
                                Add
                            </button>
                        </form>
                        <form action='profile.php' method='POST'>
                            <input type='hidden' name='userId' value='$userId'>
                            <input type='hidden' name='postId' value='$postId'>
                            <button class='input-button' name='showCommentsClick' type='submit'>
                                Show All Comments
                            </button>
                        </form>";
                       
                        echo "</label> ";
                    }
                ?>
            </td>
            <td>
                <?php
                 
                    if(isset($_POST['showCommentsClick'])) {
                        $userId = $_POST['userId'];
                        $postId = $_POST['postId'];
                        
                        $query = "SELECT title, username FROM comments WHERE userId=:userId AND postId=:postId";
                    
                        $stmt = $db->prepare($query);
                        $stmt->bindValue(':postId', $postId);
                        $stmt->bindValue(':userId', $userId);
                    
                        $results = $stmt->execute();
                        echo "<label>";
                        if ($results) {
                            echo "<h3>All Comments</h3>";
                            while ($row = $results->fetchArray()) {
                                $username = $row['username'];
                                $title = $row['title'];
                                echo "
                                <label>".$username."
                                    <input class='comment-input' name='comment' value='$title' />
                                </label>
                                ";
                            }
                            
                           
                        } else{
                              echo "No Comments</label>";
                        }
                        echo "</label>";  
                          
                            
                        
                    }
                ?>
            </td>
            <td>
            
            <?php   
                    echo "<h3>Followers</h3>";
                    $query = "SELECT username,userId FROM users WHERE userId IN (SELECT followerId from followers WHERE userId=:userId )";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':userId', $userId);
                    
                    $result = $stmt->execute();
                    echo "<label>";
                    $count = 1;
                    while ($row = $result->fetchArray()) {
                        $username = $row['username'];
                        $publicUserId = $row['userId'];
                        echo "<label>".$count.". ".$username." 
                        <form action='follow_unfollow.php' method='POST'> 
                            <input type='hidden' name='userId' value='$userId'>
                            <input type='hidden' name='followerId' value='$publicUserId'>
                            <input type='hidden' name='followerUsername' value='$username'>
                            <button class='input-button' style='float:right;' name='removeClick' type='submit'>
                                Remove
                            </button> 
                        </form> <br/></label>";
                        $count +=1;
                    }
                    echo "</label>";
                    echo "<h3>Following</h3>";
                    $query = "SELECT username,userId FROM users WHERE userId IN (SELECT followingId from followings WHERE userId=:userId )";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':userId', $userId);
                    
                    $result = $stmt->execute();
                    echo "<label>";
                    $count = 1;
                    while ($row = $result->fetchArray()) {
                        $username = $row['username'];
                        $publicUserId = $row['userId'];
                        echo "<label>".$count.". ".$username." 
                            <form action='follow_unfollow.php' method='POST'> 
                                <input type='hidden' name='userId' value='$userId'>
                                <input type='hidden' name='followingId' value='$publicUserId'>
                                <input type='hidden' name='followingUsername' value='$username'>
                                <button class='input-button' style='float:right;' name='unfollowClick' type='submit'>
                                    Unfollow
                                </button> 
                            </form> <br/></label>";
                        $count +=1;
                    }
                    echo "</label>";
                ?>
            </td>
        </tr>
    </table>
    
    
     
    
    
         
     
</div>


<?php

require_once 'includes/footer.php';
?>