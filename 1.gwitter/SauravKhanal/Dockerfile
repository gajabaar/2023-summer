FROM ubuntu:latest

COPY . /gwitter

WORKDIR /gwitter

RUN apt-get update
RUN apt-get -y upgrade

WORKDIR /gwitter

RUN bash install_sqlite3.sh
RUN bash populate_database.sh