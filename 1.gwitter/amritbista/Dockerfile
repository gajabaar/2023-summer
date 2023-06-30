FROM ubuntu/apache2:latest 

RUN apt-get update
RUN apt-get -y upgrade

RUN apt install -y sqlite3 php php-sqlite3

COPY . /var/www/html

WORKDIR /var/www/html

RUN sqlite3 gwitter.db < Database/gweet.sql
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod 777 /var/www/html/gwitter.db
