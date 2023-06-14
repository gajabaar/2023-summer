#! /bin/bash

sudo docker rm -f gwitter
sudo docker build -t gwitter . && \
sudo docker run  --name=gwitter --rm -it gwitter