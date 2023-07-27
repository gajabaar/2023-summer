sudo docker rm -f gwitter
sudo docker build -t gwitter . && \
sudo docker run -d -p 8080:80 gwitter