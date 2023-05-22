# HackTheBox: petpet rcbee
[Check the challenge Here.](https://app.hackthebox.com/challenges/petpet-rcbee)

To continue with our purposes we will download the files and extract them.

## Files
.
├── build-docker.sh # file to automate docker commands
├── challenge
│   ├── application
|   │    └── ... # main application
│   ├── flag
│   └── run.py
├── config
│   └── supervisord.conf # supervisord conf
└── Dockerfile # describe the docker image to be built


## The Application
The application is a web application that adds a petting animation to any image. For this it exposes two end points.
1. `/` For loading the website. Responds with `index.html` template.
2. `/upload` For letting the user to upload the file. It does the following actions in order:
	a. ensures a valid file exist
	b. applies a petting motion
	c. generates a GIF
	d. responds with it.

The application runs on `localhost` on port `1337`. The port will be relevant later.

## Docker
Docker is a container technology aimed to produced reproducible environment. Docker has images, containers and volumes.
- **image:** Image of the system before being run. An image is built using a docker file.
- **container:** Read Write, Copy on write loaded image. Allows resources to a process. A container is a running image.
- **volume:** Data storage method shared across containers. Databases are good places to use volumes.

## Dockerfile

	FROM python:3
Create a docker image with a based on python3 image.

---
	RUN apt update -y; apt install -y curl supervisor 
Update the image and install curl and supervisord.

---
	RUN pip install flask Pillow
Install our required pip dependencies. We should install dependencies first in order to not invalidate the cache.

---
	WORKDIR /tmp
Set the Working directory to /tmp.

---
	RUN curl -L -O https://github.com/ArtifexSoftware/ghostpdl-downloads/releases/download/gs923/ghostscript-9.23-linux-x86_64.tgz \
    && tar -xzf ghostscript-9.23-linux-x86_64.tgz \
    && mv ghostscript-9.23-linux-x86_64/gs-923-linux-x86_64 /usr/local/bin/gs && rm -rf /tmp/ghost*
    
The above lines correspond to the following actions.
1. Download a ghostscript archive.
2. Extract it.
3. Move the binary to `/usr/local/bin/gs`
4. Delete the archives.

Now ghost script should be available to execute.

---
	RUN mkdir -p /app
		
Create a app folder in `root: /`

---
	WORKDIR /app
	
Set the working directory to `app`.

---
	COPY challenge .
Copy files from `challenge` to `/app`.

---
	COPY config/supervisord.conf /etc/supervisord.conf
Copy the specified file to the specified location. `supervisord` seems to be a process manager like runit or systemd, only meant to manage processes within a project. This file is explained later.

---
	EXPOSE 1337
As noted earlier our python application opens a port in port 1337. We expose a port of the same name (and later map the map the container internal port and host port). Now we can use a browser to access the port.

---
	ENV PYTHONDONTWRITEBYTECODE=1
Do not create a `.pycache` directory. `.pycache` eliminates compilation on subsequent runs by caching the machine code of the python virtual machine. A docker image is read only and a container is not synced back the image. Therefore no two instances of docker process will benefit from this cache.

---
	ENTRYPOINT [ "/usr/bin/supervisord", "-c", "/etc/supervisord.conf" ]
This sets the command that runs in the containerized environment. Unlike `Cmd` this cannot be overridden. But it can be appended upon. `supervisord` will then launch the actual application based on the configuration.

## docker_build.sh

	docker rm -f web_petpet_rcbee
Remove an existing image called `web_petpet_rcbee`.

---
	docker build -t web_petpet_rcbee . && \
Build a image using dockerfile and name it `web_petpet_rcbee`

---
	docker run --name=web_petpet_rcbee --rm -p1337:1337 -it web_petpet_rcbee
Run the image and name the container `web_petpet_rcbee`. Remove it on exit. Map the container's port 1337 to hosts 1337. Do not close the `stdin` and allocate a pseudo `tty`.

## supervisord.conf
`supervisord` is a process management application. It looks to `/etc/supervisord.conf` for configuration. Normally docker can invoke one command on startup. Using `supervisord` we spawn multiple process in the same container.

---
	[supervisord]
	user=root
	nodaemon=true
	logfile=/dev/null
	logfile_maxbytes=0
	pidfile=/run/supervisord.pid

- Run the process as the root user.
- Do not have a daemon. A daemon being a background running process. I have not found the exact explanation of why this is needed. But I quote, [This lets Docker to manage its lifecycle](https://advancedweb.hu/supervisor-with-docker-lessons-learned/).
- Point the log file to `/dev/null`. Its a dummy file where writes are nops.
- Never switch to backupfile
- A pidfile is a text file that has pid of a process. Do not confuse them with `/proc` files.
---
	[program:flask]
	command=python -B /app/run.py
	stdout_logfile=/dev/stdout
	stdout_logfile_maxbytes=0
	stderr_logfile=/dev/stderr
	stderr_logfile_maxbytes=0   
- Declare configuration for the main flask program.
- Pipe its stdout to `/dev/stdout/`
- Since `/dev/stdout` is a stream file, you must set its max bytes to 0.
- Same for stderr files.


