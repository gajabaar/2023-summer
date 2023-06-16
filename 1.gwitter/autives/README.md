# Gwitter
Gwitter is a twitter-like social media platform.

## Update
Thus far, the database required to store the persistent data has been designed.

## Setup
Running the `build-docker.sh` file will generate a docker image named `autives-gwitter` and run a container of the same name.
The container is set to open sqlite shell utility at startup after creating the database file based on the schema provided at `./database/schema.sql`.
An SQL file with commands to populate the database is provided inside the same folder along with another file to carry out some basic queries.
Once the container is running, those files can be invoked by the following commands inside sqlite shell utility.
```
.read database/populate.sql
.read database/queries.sql
```

On running, `.exit` the shell will exit and the container will be removed.