#!/bin/bash

docker rm -f gwitter-app
docker build -t gwitter-app .  

# Create a Docker volume for the database file if it doesn't exist
docker volume create gwitter-app-data

# Start Docker container with the volume mounted
docker run -p 8000:8000 -v gwitter-app-data:/usr/src/app/database gwitter-app