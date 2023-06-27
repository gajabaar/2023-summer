FROM ubuntu/apache2:latest 


RUN apt update && apt install -y sqlite3 php php-sqlite3

COPY . /var/www/html

RUN rm /var/www/html/index.html

WORKDIR /var/www/html/database

RUN sqlite3 gwitter.db < schema.sql
RUN sqlite3 gwitter.db < populate.sql

WORKDIR /var/www/html

RUN chown -R www-data:www-data database