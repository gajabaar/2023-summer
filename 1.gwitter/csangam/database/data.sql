INSERT INTO `User` (`name`, `user_name`, `email`, `password`)
VALUES
    ('John Doe', 'johndoe', 'johndoe@example.com', 'password123'),
    ('Jane Smith', 'janesmith', 'janesmith@example.com', 'pass987'),
    ('Mike Johnson', 'mikejohn', 'mikejohn@example.com', 'mikepass');

INSERT INTO `Gweet` (`content`, `creator`)
VALUES
    ('Hello, world!', (SELECT `user_id` FROM `User` WHERE `user_name` = 'johndoe')),
    ('Having a great day!', (SELECT `user_id` FROM `User` WHERE `user_name` = 'janesmith')),
    ('Feeling excited about this new project.', (SELECT `user_id` FROM `User` WHERE `user_name` = 'mikejohn'));

INSERT INTO `Follower` (`user_id`, `follower_id`)
VALUES
    ((SELECT `user_id` FROM `User` WHERE `user_name` = 'johndoe'), (SELECT `user_id` FROM `User` WHERE `user_name` = 'janesmith')),
    ((SELECT `user_id` FROM `User` WHERE `user_name` = 'janesmith'), (SELECT `user_id` FROM `User` WHERE `user_name` = 'mikejohn')),
    ((SELECT `user_id` FROM `User` WHERE `user_name` = 'johndoe'), (SELECT `user_id` FROM `User` WHERE `user_name` = 'mikejohn'));
