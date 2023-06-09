# Designing a Simple Database for a Gwitter

## Introduction

This is how I designed a simple database using sqlite3 for a Twitter-like app named "Gwitter". The database includes tables for users, tweets, likes, retweets, shares, followers, and followings.

## Tables

### Users

The `users` table stores information about each user, including their unique ID, username, password, email, and the timestamp of when their account was created.

```sql
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    email TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tweets

The `tweets` table stores information about each tweet, including the unique ID of the tweet, the ID of the user who created the tweet, the content of the tweet, and the timestamp of when the tweet was created.

```sql 
CREATE TABLE tweets (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Likes

The `likes` table stores information about each like, including the unique ID of the action, the ID of the user who performed the action, the ID of the tweet that was liked, and the timestamp of when the action was performed.

```sql 
CREATE TABLE likes (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    tweet_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);
```

### Retweets

The `retweets` table stores information about each retweet, including the unique ID of the action, the ID of the user who performed the action, the ID of the tweet that was retweeted, and the timestamp of when the action was performed.

```sql 
CREATE TABLE retweets (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    tweet_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);
```

### Shares

The `shares` table stores information about each share, including the unique ID of the action, the ID of the user who performed the action, the ID of the tweet that was shared, and the timestamp of when the action was performed.

```sql
CREATE TABLE shares (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    tweet_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);
```

### Followers

The `followers` table stores information about each follower relationship, including the unique ID of the relationship, the ID of the follower, the ID of the followee, and the timestamp of when the relationship was created.

```sql
CREATE TABLE followers (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    follower_id INTEGER NOT NULL,
    followee_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (followee_id) REFERENCES users(id)
);
```

### Followings

The `followings` table stores information about each followee relationship, including the unique ID of the relationship, the ID of the follower, the ID of the followee, and the timestamp of when the relationship was created.

```sql
CREATE TABLE followings (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    follower_id INTEGER NOT NULL,
    followee_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (followee_id) REFERENCES users(id)
);
```

## Conclusion

With these tables, we can create a simple database to store and retrieve user information, tweets, likes, retweets, shares, and follower/following relationships for "Gwitter".