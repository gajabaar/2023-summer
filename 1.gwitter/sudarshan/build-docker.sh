#!/bin/bash

docker rm -f gwitter-sudru
docker build . -t gwitter-sudru
docker run --name=gwitter-sudru --rm -p 8080:80 -it gwitter-sudru
