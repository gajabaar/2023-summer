#!/bin/bash

# Function to run SQLite commands
run_sqlite_command() {
    sqlite3 gwitter.db "$1"
}

# Insert data into the Users table
run_sqlite_command "INSERT INTO users (username, password, email, created_at) VALUES
('john_doe', 'password123', 'john_doe@example.com', '2023-06-01 10:00:00'),
('jane_smith', 'pass456', 'jane_smith@example.com', '2023-06-02 12:30:00'),
('alex_carter', 'abc123', 'alex_carter@example.com', '2023-06-03 15:45:00'),
('emily_wilson', 'emily987', 'emily_wilson@example.com', '2023-06-04 09:20:00'),
('michael_harris', 'mike456', 'michael_harris@example.com', '2023-06-05 11:10:00'),
('sarah_jones', 'sarahpass', 'sarah_jones@example.com', '2023-06-06 14:05:00'),
('david_smith', 'davidpass123', 'david_smith@example.com', '2023-06-07 16:30:00'),
('olivia_brown', 'olivia987', 'olivia_brown@example.com', '2023-06-08 08:15:00'),
('william_johnson', 'will456', 'william_johnson@example.com', '2023-06-09 10:40:00'),
('sophia_taylor', 'sophia123', 'sophia_taylor@example.com', '2023-06-10 13:55:00')"

# Insert data into the Tweets table
run_sqlite_command "INSERT INTO tweets (user_id, content, created_at) VALUES
(1, 'Hello world!', '2023-06-01 10:01:00'),
(1, 'Having a great day!', '2023-06-01 11:30:00'),
(2, 'Excited for the weekend!', '2023-06-02 12:31:00'),
(3, 'Just finished an amazing book!', '2023-06-03 15:50:00'),
(4, 'Enjoying the sunshine!', '2023-06-04 09:25:00'),
(5, 'Working on a new project.', '2023-06-05 11:15:00'),
(6, 'Exploring a new city!', '2023-06-06 14:10:00'),
(7, 'Attending a conference today.', '2023-06-07 16:35:00'),
(8, 'Trying out a new recipe.', '2023-06-08 08:20:00'),
(9, 'Looking forward to the weekend!', '2023-06-09 10:45:00')"

# Insert data into the Likes table
run_sqlite_command "INSERT INTO likes (user_id, tweet_id, created_at) VALUES
(1, 1, '2023-06-01 10:02:00'),
(2, 1, '2023-06-01 10:03:00'),
(2, 2, '2023-06-02 12:32:00'),
(3, 3, '2023-06-03 15:51:00'),
(4, 4, '2023-06-04 09:26:00'),
(5, 5, '2023-06-05 11:16:00'),
(6, 6, '2023-06-06 14:11:00'),
(7, 7, '2023-06-07 16:36:00'),
(8, 8, '2023-06-08 08:21:00'),
(9, 9, '2023-06-09 10:46:00')"

# Insert data into the Followings table
run_sqlite_command "INSERT INTO followings (follower_id, followee_id, created_at) VALUES
(1, 2, '2023-06-01 10:04:00'),
(2, 1, '2023-06-01 10:05:00'),
(3, 1, '2023-06-02 12:33:00'),
(4, 2, '2023-06-03 15:52:00'),
(5, 3, '2023-06-04 09:27:00'),
(6, 4, '2023-06-05 11:17:00'),
(7, 5, '2023-06-06 14:12:00'),
(8, 6, '2023-06-07 16:37:00'),
(9, 7, '2023-06-08 08:22:00'),
(10, 8, '2023-06-09 10:47:00')"

# Insert data into the Followers table
run_sqlite_command "INSERT INTO followers (follower_id, followee_id, created_at) VALUES
(1, 2, '2023-06-01 10:06:00'),
(2, 1, '2023-06-01 10:07:00'),
(3, 1, '2023-06-02 12:34:00'),
(4, 2, '2023-06-03 15:53:00'),
(5, 3, '2023-06-04 09:28:00'),
(6, 4, '2023-06-05 11:18:00'),
(7, 5, '2023-06-06 14:13:00'),
(8, 6, '2023-06-07 16:38:00'),
(9, 7, '2023-06-08 08:23:00'),
(10, 8, '2023-06-09 10:48:00')"
