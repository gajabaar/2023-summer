-- List all the Users
SELECT * FROM Users;

-- Get UserID from username
SELECT userId
FROM Users
WHERE username = 'user1';

-- List all the gweets from a user
-- TODO: Refine this query
WITH g1 AS (
    SELECT *
    FROM Gweets
    WHERE userId = 3
)
SELECT * FROM g1
JOIN (SELECT [data], [gweetId] 
      FROM Gweets
      WHERE EXISTS(SELECT original FROM g1)
      ) AS g2
ON g1.original = g2.gweetId;

-- List all the followers of a user specified by userId
SELECT userId, username, joinedOn
FROM Users
WHERE userId = (SELECT followerId
                FROM Followers
                WHERE followeeId = 1);

-- List the comments on a post
SELECT * 
FROM Comments
WHERE gweetId = 1;

-- List all the users who liked a post
SELECT userId, username, joinedOn
FROM Users
WHERE userId = (SELECT userId
                FROM Gweets
                Where gweetId = 1);
