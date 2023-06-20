ALTER TABLE users ADD COLUMN email TEXT;
-- added new column email in users table
CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(30) NOT NULL UNIQUE,
    passkey TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS followed_by(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(30) NOT NULL,
    followed_by VARCHAR(30) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    FOREIGN KEY (follows) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS gweets(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(30) NOT NULL,
    gweet TEXT NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

PRAGMA foreign_keys = ON;