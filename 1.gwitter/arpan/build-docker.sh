#!/bin/bash

docker rm -f arpan_gwitter
docker build -t arpan_gwitter .

# Create a Docker volume for the database file if it doesn't exist
docker volume create arpan_gwitter-data

# Start Docker container with the volume mounted
docker run -p 8080:80 -v arpan_gwitter-data:/var/www/html/database arpan_gwitter

