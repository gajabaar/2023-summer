FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .
RUN touch gwitter.db
RUN chmod +w ./gwitter.db
RUN apt update
RUN apt upgrade
RUN apt install sqlite3 libsqlite3-dev
RUN cat migrations/create_users.sql | sqlite3 gwitter.db
RUN cat migrations/create_tweets.sql | sqlite3 gwitter.db
RUN cat migrations/create_replies.sql | sqlite3 gwitter.db
RUN chown -R www-data:www-data ./gwitter.db
ENV SALT=BJOR
