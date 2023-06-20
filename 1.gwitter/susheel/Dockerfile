FROM ubuntu/apache2:latest 



RUN apt-get update
RUN apt-get -y upgrade

COPY . /var/www/html

WORKDIR /var/www/html
RUN ls

RUN bash install_sqlite3.sh
RUN bash database/populate_database.sh
RUN bash install_php.sh







