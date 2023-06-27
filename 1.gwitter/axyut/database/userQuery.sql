
-- Create User
INSERT INTO users ("Username", "Password") VALUES 
( "<USERNAME>", "<PASSWORD>");

-- Create Post
INSERT INTO posts ("UserId", "Title") VALUES 
(<YourUserId>, "<Title>");

-- Create Comment 
INSERT INTO comments ("PostId", "UserId", "Title") VALUES 
(<PostId>, <YourUserId>, "<Comment>");

-- Show all post of particular user
SELECT * FROM posts WHERE username="<Username>";

-- Show all comment of particular post of particular user
SELECT * FROM comments 
WHERE userid= (SELECT id FROM users WHERE username=<Username>) 
AND  postid=<PostId>;

-- Show all your followers
SELECT followerid FROM followers WHERE userid=<UserId>;
-- No. of followers
SELECT COUNT(*) FROM followers WHERE userid=<UserId>;
 
-- Show all who you're following 
SELECT followingid FROM followings WHERE userid=<UserId>;
-- Show No. of people you're following
SELECT COUNT(*) FROM followings WHERE userid=<UserId>;

-- Mutual followers
SELECT followerid FROM followers WHERE followerid IN (SELECT followingid FROM followings WHERE userid=<UserId>)
AND userid=<UserId>;