#!/bin/bash

docker rm -f nischhal-gwitter
docker build -t nischhal-gwitter .

# Create a Docker volume for the database file if it doesn't exist
docker volume create nischhal-gwitter-data

# Start Docker container with the volume mounted
docker run -p 5000:80 -v nischhal-gwitter-data:/var/www/html/database nischhal-gwitter
