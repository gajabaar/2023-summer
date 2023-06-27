#! /bin/bash

sqlite3 gwitter.sqlite3 < database/models/comments.sql
sqlite3 gwitter.sqlite3 < database/models/followers.sql
sqlite3 gwitter.sqlite3 < database/models/followings.sql
sqlite3 gwitter.sqlite3 < database/models/gweets.sql
sqlite3 gwitter.sqlite3 < database/models/likes.sql
sqlite3 gwitter.sqlite3 < database/models/messages.sql
sqlite3 gwitter.sqlite3 < database/models/repost.sql
sqlite3 gwitter.sqlite3 < database/models/share.sql
sqlite3 gwitter.sqlite3 < database/models/users.sql

sqlite3 gwitter.sqlite3 < database/data/populate_comments.sql
sqlite3 gwitter.sqlite3 < database/data/populate_followers.sql
sqlite3 gwitter.sqlite3 < database/data/populate_followings.sql
sqlite3 gwitter.sqlite3 < database/data/populate_gweet.sql
sqlite3 gwitter.sqlite3 < database/data/populate_likes.sql
sqlite3 gwitter.sqlite3 < database/data/populate_messages.sql
sqlite3 gwitter.sqlite3 < database/data/populate_repost.sql
sqlite3 gwitter.sqlite3 < database/data/populate_share.sql
sqlite3 gwitter.sqlite3 < database/data/populate_users.sql

echo "Successfully created and populated data in database"
echo "Happy Hacking"
