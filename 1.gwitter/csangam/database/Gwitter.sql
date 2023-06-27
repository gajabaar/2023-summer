PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS `User` (
    `user_id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `name` TEXT NULL,
    `user_name` TEXT NOT NULL UNIQUE,
    `email` TEXT NOT NULL UNIQUE,
    `password` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `Gweet` (
    `gweet_id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `content` TEXT NOT NULL,
    `creator` INTEGER NOT NULL,
    FOREIGN KEY(`creator`) REFERENCES `User`(`user_id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `Follower` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER NOT NULL,
    `follower_id` INTEGER NOT NULL,
    FOREIGN KEY(`user_id`) REFERENCES `User`(`user_id`) ON DELETE CASCADE,
    FOREIGN KEY(`follower_id`) REFERENCES `User`(`user_id`) ON DELETE CASCADE
);
