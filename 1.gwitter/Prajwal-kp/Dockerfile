# Use a PHP base image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the application files to the container
COPY . /var/www/html

# Install PDO SQLite extension
RUN docker-php-ext-install pdo pdo_sqlite

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
