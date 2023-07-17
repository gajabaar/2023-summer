#!/bin/bash

sudo docker rm -f gwitter
sudo docker build -t gwitter 
sudo docker run -name=gwitter --rm -p 0.0.0.0:3000 gwitter