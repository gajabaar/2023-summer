#!/bin/bash

docker rm -f gwitter
docker build -t gwitter .
docker run -p 8080:80 my-php-app
