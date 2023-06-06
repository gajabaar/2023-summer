
#Create tables

sqlite3 gwitter.sqlite3 < Database/comments.sql
sqlite3 gwitter.sqlite3 < Database/followers.sql
sqlite3 gwitter.sqlite3 < Database/tweets.sql
sqlite3 gwitter.sqlite3 < Database/likes.sql
sqlite3 gwitter.sqlite3 < Database/retweets.sql
sqlite3 gwitter.sqlite3 < Database/users.sql

#Populate data
sqlite3 gwitter.sqlite3 < Populate/populate_comments.sql
sqlite3 gwitter.sqlite3 < Populate/populate_followers.sql
sqlite3 gwitter.sqlite3 < Populate/populate_likes.sql
sqlite3 gwitter.sqlite3 < Populate/populate_retweets.sql
sqlite3 gwitter.sqlite3 < Populate/populate_tweets.sql
sqlite3 gwitter.sqlite3 < Populate/populate_users.sql


