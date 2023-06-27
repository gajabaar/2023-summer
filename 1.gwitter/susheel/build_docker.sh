#! /bin/bash

sudo docker rm -f gwitter
sudo docker compose build --no-cache && sudo docker compose up