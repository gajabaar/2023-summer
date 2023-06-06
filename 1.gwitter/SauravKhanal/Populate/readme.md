Abstract:
- This report presents the database design and implementation for Gwitter, a social media platform that facilitates user engagement and content sharing. The document details the specific data to be stored and provides SQL statements required to create the necessary tables.

Database Schema:
- The Gwitter database incorporates four primary tables: Users, Posts, Followers, and Comments. Each table serves a distinct purpose:

Users: 
- This table stores comprehensive user information, including their unique user ID, username, email, hashed password, profile picture, bio, and registration date. The user ID acts as the primary key.

Posts: 
- The Posts table houses user-generated content, encompassing a post ID, user ID (referencing the Users table as a foreign key), post content, timestamp, as well as like and retweet counts. The post ID serves as the primary key.

Followers: 
- Establishing the association between users and their followers, the Followers table contains user ID and follower ID columns. Both fields reference the Users table as foreign keys, and their combination forms a unique key.

Comments: 
- The Comments table stores user comments on Gwitter posts. It includes a comment ID (primary key), post ID (foreign key referencing the Posts table), user ID (foreign key referencing the Users table), comment content, and timestamp.

