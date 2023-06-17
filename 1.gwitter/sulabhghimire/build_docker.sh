#!/bin/bash

docker rm -f gwitter
docker build -t gwitter .

# Create a Docker volume for the database file if it doesn't exist
docker volume create gwitter-data

# Start Docker container with the volume mounted
docker run -p 8080:80 -v gwitter-data:/var/www/html/database gwitter