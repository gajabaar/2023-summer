# Database
I have made 3 databases:
- `Users` to store the information of created user accounts.
- `Gweets` to store the individual gweets and replies.
- `Reply` to store the parent child relation of Reply Gweets.

## Files
The database files are inside the migrations folder. Although I did not use any migrations in this project, I used the naming convention out of habit.
1. create_users.sql
2. create_tweets.sql
3. create_replies.sql

## Schema
- Users Table
```sql
Users(
	name -- The name of the user, unused
	username, -- The unique handle
	password, -- the hash of the password
	birthday -- the birthday, unused
);

```

- Tweets Table
```sql
Gweets(
	username, -- The user who tweeted
	id, -- the id of tweet
	gweet, -- the contents of tweet
	time, -- time of tweet
	isreply, -- if the tweet is a reply

	FOREIGN KEY (username) REFERENCES Users(username)
);
```

- Replies Table
```sql
Reply(
	parent_id, -- the parent gweet id
	reply_id, -- the child gweet id

    FOREIGN KEY (parent_id) REFERENCES Gweets(id),
	FOREIGN KEY (reply_id) REFERENCES Gweets(id)
);

```