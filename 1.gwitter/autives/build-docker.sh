#!/bin/bash

docker rm -f autives-gwitter
docker build --tag=autives-gwitter .
docker run -it --name=autives-gwitter autives-gwitter