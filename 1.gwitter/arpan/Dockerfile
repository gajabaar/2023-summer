FROM php:latest

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html

COPY . .

CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
