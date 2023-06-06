INSERT INTO Users (username, password, joinedOn)
VALUES
    ('user1', 'password1', DATETIME('now')),
    ('user2', 'password2', DATETIME('now')),
    ('user3', 'password3', DATETIME('now'));

INSERT INTO Gweets (userId, data, timestamp)
VALUES
    (1, 'Gweet data 1', DATETIME('now')),
    (2, 'Gweet data 2', DATETIME('now')),
    (1, 'Gweet data 3', DATETIME('now'));

-- Regweets
INSERT INTO Gweets (userId, original, timestamp)
VALUES
    (3, 1, DATETIME('now'));

INSERT INTO Comments (gweetId, parent, userId, data, timestamp)
VALUES
    (1, NULL, 2, 'Comment data 1', DATETIME('now')),
    (1, NULL, 3, 'Comment data 2', DATETIME('now')),
    (2, NULL, 1, 'Comment data 3', DATETIME('now'));

INSERT INTO Followers (followerId, followeeId, since)
VALUES
    (1, 2, DATETIME('now')),
    (1, 3, DATETIME('now')),
    (2, 1, DATETIME('now'));

INSERT INTO Likes (likedGweet, likedBy, timestamp)
VALUES
    (1, 2, DATETIME('now')),
    (2, 3, DATETIME('now')),
    (3, 1, DATETIME('now'));
