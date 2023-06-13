<?php
session_start(); 
require_once 'includes/header.php';

$db = new SQLite3("database/gwitter.db");

$username = $_SESSION["username"];
$userId = $_SESSION["userId"];

?>

<div class="home-container">
    <table>
        
        <tr>
            <td>
                <form action="home.php" method="post">
                    <textarea class="input-gweet" type="text" name="title" placeholder="Title">What's on your mind?</textarea>
                    <br/><button class="active-btn" type="submit"><span>Gweet</span></button> 
                    
                </form>
                <?php
                    if (isset($_POST['title'])) {
                        $title = $_POST['title'];
                        $query = "INSERT INTO posts ('userId', 'username', 'title') VALUES (:userId, :username, :title)";

                        $stmt = $db->prepare($query);
                        $stmt->bindValue(':userId', $userId);
                        $stmt->bindValue(':username', $username);
                        $stmt->bindValue(':title', $title);
                    

                        $result = $stmt->execute();
                        if ($result) {
                           
                            header("Location: home.php?msg=PostSuccessfull");
                            exit();
                        } else {
                
                            header("Location: home.php?msg=Error!tryAgain");
                            exit();
                        }
                    }?>

                <h3>Following feed</h3>
                <?php
                    $db = new SQLite3("database/gwitter.db");

                    $userId = $_SESSION["userId"];
                    $query = "SELECT * FROM posts WHERE userId IN (SELECT followingId from followings WHERE userId=:userId )";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':userId', $userId);
                    
                    $result = $stmt->execute();
                    while ($row = $result->fetchArray()) {
                        $title = $row['title'];
                        $username = $row['username'];
                        $postId = $row['postId'];
                        echo "<label>"
                            .$username."<p>".$title."</p>
                            <br/>
                            <form action='delete_edit_comment.php' method='POST'> 
                            <input type='hidden' name='userId' value='$userId'>
                            <input type='hidden' name='postId' value='$postId'>
                            <input type='hidden' name='username' value='$username'>
                            <input type='hidden' name='title' value='$title'>
                            <input class='comment-input' name='comment' placeholder='My comment' /> 
                                <button style='float:right;' class='input-button' name='addCommentHomeClick'>
                                    Add
                                </button>
                                
                            </form>
                            <form action='home.php' method='POST'>
                                <input type='hidden' name='userId' value='$userId'>
                                <input type='hidden' name='postId' value='$postId'>
                                <button class='input-button' name='showCommentsClick' type='submit'>
                                    Show All Comments
                                </button>
                            </form>
                            </label>";
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
               
                    $query = "SELECT username, userId FROM users WHERE userId NOT IN (SELECT followingId from followings WHERE userId=:userId ) AND NOT userId= :userId";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':userId', $userId);
                    
                    $result = $stmt->execute();
                    echo "<label>";
                    echo "<h3> From your contacts </h3>";
                    $count = 1;
                    while ($row = $result->fetchArray()) {

                        $username = $row['username'];
                        $publicUserId = $row['userId'];
                        echo "<label>".$count.". ".$username."
                            <form action='follow_unfollow.php' method='POST'> 
                                <input type='hidden' name='userId' value='$userId'>
                                <input type='hidden' name='followingId' value='$publicUserId'>
                                <input type='hidden' name='followingUsername' value='$username'>
                                <button class='input-button' style='float:right;' name='followClick' type='submit'>
                                    Follow
                                </button> 
                            </form> 
                            <br/></label>";
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