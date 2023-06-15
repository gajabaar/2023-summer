FROM php:8.1

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev

RUN cd database && sqlite3 gwitter.db < schema.sql && sqlite3 gwitter.db < data.sql

EXPOSE 80

CMD ["php","-S","0.0.0.0:80"]
