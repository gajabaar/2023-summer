# Base image
FROM php:latest

# Set working directory
WORKDIR /var/www/html

# Copy the PHP files to the container
COPY . /var/www/html

# Install SQLite3 extension
RUN docker-php-ext-install pdo pdo_sqlite

# Create and initialize the SQLite database
RUN touch gwitter.db && \
    chmod 777 gwitter.db && \
    php initialize_database.php

# Expose port 80
EXPOSE 80

# Start the PHP development server
CMD ["php", "-S", "0.0.0.0:80"]
