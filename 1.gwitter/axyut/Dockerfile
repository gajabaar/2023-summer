FROM ubuntu/apache2:latest 


RUN apt update && apt install -y sqlite3 php php-sqlite3

COPY . /var/www/html

RUN rm /var/www/html/index.html

WORKDIR /var/www/html

RUN bash database/populate.sh