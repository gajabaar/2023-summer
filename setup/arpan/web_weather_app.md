# Hackthebox weather_app challenge's docker setup explanation
We were provided with a zip file . Upon unzipping the file with password 'hackthebox' , there were folders named challenge , config and files named build-docker.sh and Dockerfile. Below is the explanation of the files :

![folders.png](/setup/arpan/assets/folders.png)

## 1. build-docker.sh
This is the script used to build the docker image.

```
!/bin/bash 
docker build --tag=weather_app .
docker run -p 1337:80 --rm --name=weather_app -it weather_app

```


- `#!/bin/bash`: It is called shebang and it specifies that we are using bash script

- `docker build --tag=weather_app .`: This command builds a docker image having the tag/name “weather_app” in the current directory

- `docker run -p 1337:80 --rm --name=weather_app -it weather_app`: It runs the docker by mapping the port 1337 to port 80 in the container which helps us to access the application running inside the container via http://localhost:1337 . — rm specifies that it removes the container when it exists . The container is given name ‘weather_app’ . -it allocates an interactive pseudo tty and allows interaction with the container’s command line. It then runs the docker image named weather_app

## 2. **DockerFile**
It is a file having a set of instructions required used to build docker image.

```
FROM node:8.12.0-alpine

# Install packages
RUN apk add --update --no-cache supervisor

# Setup app
RUN mkdir -p /app

# Add application
WORKDIR /app
COPY challenge .

# Install dependencies
RUN npm install

# Setup superivsord
COPY config/supervisord.conf /etc/supervisord.conf

# Expose the port node-js is reachable on
EXPOSE 80

# Start the node-js application
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
```


- `FROM node:8.12.0-alpine`: It means that the base image will be build under Node.js version 8.12.0 which will be running on Alpine linux

- `# Install packages`

    `RUN apk add --update --no-cache supervisor`: This will install the package named supervisor using alpine package manager apk , which will be used to run and moniter the Node.js application and the cached index files aren’t used

- `# Setup app`
 
    `RUN mkdir -p /app`   : This will make a directory named /app in the image filesystem . -p flag creates the parent directories if they don’t exist

- `# Add application`

  `WORKDIR /app COPY challenge .`: It will set the working directory as /app and any folllowing instructions will be executed in the context of this directory. It will then copy the content of the local challenge directory to /app directory in the image . The ‘.’ means the current directory where the dockerfile resides

- `# Install dependencies`

    `RUN npm install`: It will install npm which is node package manager within the /app directory . It installs the dependencies of the Node.js application by resolving them from the package.json file present in the copied challenge directory.

- `# Setup superivsord`

   `COPY config/supervisord.conf /etc/supervisord.conf`: The supervisord.conf file located in the config directory of the build context is copied to /etc/supervisord.conf inside the image.

- `# Expose the port node-js is reachable on`

   `EXPOSE 80`: It informs docker that the container will listen on port 80

- `# Start the node-js application`

  `CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]`: It sets the command to be executed when the container starts. It runs the supervisord command, specifying the configuration file location (/etc/supervisord.conf). This will start the Supervisor process, which will manage the execution of the Node.js application

## 3. config
It has supervisord.conf file.


###  supervisord.conf

![supervisord.png](/setup/arpan/assets/supervisord.png)

```
[supervisord]
nodaemon=true
logfile=/dev/null
logfile_maxbytes=0
pidfile=/run/supervisord.pid

[program:express]
command=npm start
directory=/app
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
```

`[supervisord]`

This section is for the configuration of supervisord :

- `nodaemon=true`: This setting tells Supervisor to run in the foreground, meaning it doesn't detach from the terminal. This is necessary when running Supervisor inside a Docker container.
- `logfile=/dev/null`: Supervisor generates its own log files, but setting the logfile to /dev/null means the log output is discarded. Since Supervisor runs in the foreground, saving the logs to a file may not be necessary in this case.
- `logfile_maxbytes=0`: This sets the maximum size limit for the log files to 0 bytes. It means there is no maximum limit, allowing the log files to grow without restriction. This might be useful for debugging purposes or if you want to capture all the log output.
- `pidfile=/run/supervisord.pid`: This specifies the path where Supervisor should store its process ID (PID) file. The PID file is a small text file that contains the process ID of the running Supervisor instance. By default, it is stored in the /run directory.

`[program:express]`

This section defines a program named `express` that Supervisor will manage:

- `command=npm start`: This specifies the command to start the express program. In this case, it runs the npm start command, which is typically used to start a Node.js application defined in the package.json file.
- `directory=/app`: This sets the working directory for the express program to /app. It means that the express program will be executed within the /app directory.
- `stdout_logfile=/dev/stdout` and `stderr_logfile=/dev/stderr`: These lines define where the program's standard output (stdout) and standard error (stderr) should be logged. Here, they are set to /dev/stdout and /dev/stderr, respectively. This means that the stdout and stderr output of the express program will be redirected to the container's standard output and standard error streams.
- `stdout_logfile_maxbytes=0` and `stderr_logfile_maxbytes=0`: These options set the maximum log file size for the stdout and stderr logs to 0, indicating that there is no maximum size limit. As a result, the log files for stdout and stderr will keep growing without any restrictions.

## 4. Challenge
This folder contains the essential codes for running the application.

![challenge.png](/setup/arpan/assets/challenege.png)

## 5. Running the docker image.
It can be run by ./build-docker.sh  . We can access the application through https://localhost:1337

![docker-run.png](/setup/arpan/assets/docker-run.png)

Upon browsing http://localhost:1337 , we can view the challenge/application running:

![application.png](/setup/arpan/assets/application.png)

We can now solve the challenge and get the flag which indicates the completion of the challenge.