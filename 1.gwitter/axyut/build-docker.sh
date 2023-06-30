#! /bin/bash

sudo docker rm -f gwitter
sudo docker build -t gwitter . && \
sudo docker run  --name=gwitter --rm -it -p 0.0.0.0:80:80 gwitter