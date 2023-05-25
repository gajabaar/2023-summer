# Hack The Box Challange -> `lovetok`

## Report on working of different docker files present on `HTB Challenge` 


Challenge : web_lovetok

We started with downloading the file 

![alt text](./assets/Pasted%20image.png)

Extract the downloaded zip (password:hackthebox)

We get following files :

![alt text](./assets/Pasted%20image%201.png)

Explaination of each files (`build_docker.sh`, `Dockerfile`, `entrypoint.sh`)

### 1.`build_docker.sh`
    
    The script starts by removing any existing container with the same name using the command "docker rm -f lovetok". The "-f" flag forces the removal of the container even if it's currently running.

    Next, the script builds a Docker image with the tag "lovetok" using the Dockerfile in the current directory with the command "docker build -t lovetok .". The "-t" flag specifies the tag to use for the image, and the "." specifies the build context, which is the current directory.

    Finally, the script runs the Docker container with the name "lovetok" using the command "docker run --name=lovetok --rm -p1337:80 -it lovetok". The "--name" flag specifies the name of the container, the "--rm" flag automatically removes the container when it stops running, the "-p" flag maps port 1337 on the host to port 80 in the container, and the "-it" flags allocate a pseudo-TTY and keep STDIN open even if not attached.

### 2.`Dockerfile`

    This is a Dockerfile that builds a Docker image based on the debian:buster-slim base image.

    Breakdown of what each line does:

2.1 `FROM debian:buster-slim`

    This line sets the base image for the Dockerfile to debian:buster-slim. 
    This is a lightweight version of the Debian Buster operating system.

2.2 `RUN useradd www`

    This creates a new user called www.

2.3 `RUN apt-get update && apt-get install -y supervisor nginx lsb-release wget`

    This updates the package list and installs some system packages that will be needed by the web server: supervisor, nginx, lsb-release, and wget.

`RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list`

    This downloads and adds a GPG key for the php package repository, and adds the repository to the system's package sources.

2.4 `RUN apt update && apt install -y php7.4-fpm`

    This updates the package list and installs the PHP 7.4 FastCGI Process Manager (FPM) package.

2.5 `COPY config/fpm.conf /etc/php/7.4/fpm/php-fpm.conf`

2.6 `COPY config/supervisord.conf /etc/supervisord.conf`

2.7 `COPY config/nginx.conf /etc/nginx/nginx.conf`

    These lines copy configuration files for PHP-FPM, supervisord, and nginx from the local `config` directory to their respective locations in the Docker image.

2.8 `COPY challenge /www`
    
    This copies the contents of the `challenge` directory to the `/www` directory in the Docker image.

2.9 `COPY flag /`

    This copies the `flag` file to the root directory of the Docker image.

2.10 `RUN chown -R www:www /www /var/lib/nginx`

    This changes the ownership of the `/www` and `/var/lib/nginx` directories to the `www` user that was created earlier.


2.11 `EXPOSE 80`

    This exposes port 80, which is the default port for HTTP traffic.


2.12 `COPY --chown=root entrypoint.sh /entrypoint.sh`

2.13 `ENTRYPOINT ["/entrypoint.sh"]`

    This copies the `entrypoint.sh` script to the root directory of the Docker image, sets the owner to `root`, and specifies it as the entrypoint for the Docker container.


2.14 `CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]`

    This sets the command to runwhen the Docker container starts. It runs `supervisord` with the configuration file located at `/etc/supervisord.conf`, which will start and manage the nginx and php-fpm processes.

### 3.`entrypoint.sh`

    This is a script that will be run as the entrypoint when the Docker container starts. Here's a breakdown of what each line does:

3.1 `chmod 600 /entrypoint.sh`

    This changes the permissions of the entrypoint.sh script to be executable only by the owner

3.2 `FLAG=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 5 | head -n 1)`

    This generates a random string of 5 alphanumeric characters and assigns it to the FLAG variable.

3.2 `mv /flag /flag$FLAG`

    This renames the /flag file to /flag$FLAG, where $FLAG is the random string generated in the previous line. This makes it harder for an attacker to guess the file name of the flag.

3.3 `exec "$@"`

    This executes the command that was specified when the Docker container was started. This command will typically be supervisord with the configuration file located at /etc/supervisord.conf, as specified in the Dockerfile's CMD instruction.


    

