
# HackTheBox LoveTok Challenge Machine Development Explained

Let's break down the working mechanism of a HackTheBox Web Challenge Machine LoveTok.
### Start With Downloading the Files Given by the Challenge
1. Login to your HackTheBox Account.
2. [Click here](https://app.hackthebox.com/challenges/lovetok) view the challenge.
3. Click on the download section. 

 
After the download, extract the zip file with the cited passoword "**hackthebox**".

Now, after opening the unzipped folder `web_lovetok/` you may find out the following files and folders.

![Available files and folders.](/assets/all-creds.png)

Here, 
```
#!/bin/bash
docker rm -f lovetok
docker build -t lovetok . && \
docker run --name=lovetok --rm -p1337:80 -it lovetok
```

1. `build_docker.sh` is a bash script file where,

    `#!/bin/bash` is a shebang and specifies the interpreter to be used, in this case, Bash.

    `docker rm -f lovetok` Removes any existing Docker container named "lovetok"

    `docker build -t lovetok ` Build a Docker image named "lovetok" based on the Dockerfile in the current directory.

    `docker run --name lovetok --rm -p1337:80 -it lovetok` Run a new Docker container named "lovetok" based on the "lovetok" image, exposing it on port 1337 of the host machine

2. `challenge/` folder is the source code for the Website that will be provided for us to pentest.
![websource](/assets/web-source.png)

3. `config/` directory has all the config file for the PHP-FPM, Nginx, and Supervisord components of the LoveTok web application.
    
    ![Files](/assets/conf-details.png)

    - `fpm.conf` is a configuration file for PHP-FPM (FastCGI Process Manager), which is responsible for handling PHP requests on the server. It likely contains settings related to PHP-FPM's behavior, such as the number of worker processes, process priorities, and resource limits.
    ```
    [global]
    daemonize = no
    error_log = /dev/stderr
    log_level = notice

    [www]
    user = www
    group = www

    clear_env = On

    listen = /run/php-fpm.sock
    listen.owner = www
    listen.group = www

    pm = dynamic
    pm.max_children = 15
    pm.start_servers = 2
    pm.min_spare_servers = 1
    pm.max_spare_servers = 3
    ```

    `[global] section`:

    `daemonize = no`: PHP-FPM does not run in the background as a daemon.
    `error_log = /dev/stderr`: Error logs are redirected to the standard error output.
    `log_level = notice`: The log level is set to "notice", which means only important events are logged.
    `[www] section`:

    `user = www and group = www`: PHP-FPM runs as the user and group "www".
    `clear_env = On`: Environment variables are cleared before PHP-FPM processes are spawned.
    Connection settings:

    `listen = /run/php-fpm.sock`: PHP-FPM listens for connections on the Unix socket /run/php-fpm.sock.
    `listen.owner = www and listen.group = www`: The owner and group of the listening socket are set to "www".
    **Process management:**

    `pm = dynamic`: PHP-FPM uses a dynamic process manager.
    `pm.max_children = 15`: The maximum number of child processes is set to 15.
    `pm.start_servers = 2`: The number of child processes initially created when PHP-FPM starts is 2.
   ` pm.min_spare_servers = 1`: The minimum number of idle child processes is 1.
    `pm.max_spare_servers = 3`: The maximum number of idle child processes is 3.
   This PHP-FPM configuration ensures that PHP-FPM runs in the foreground, logs important events to the standard error output, sets the user and group for PHP-FPM processes, clears environment variables, listens for connections on a Unix socket, and manages child processes dynamically with specific limits on their number.
    - `nginx.conf` is a file for Nginx, a web server and reverse proxy server. It defines how Nginx handles incoming HTTP requests and serves static and dynamic content. The nginx.conf file typically includes various directives related to server behavior, caching, SSL/TLS configuration, and proxying.
        ```
        user www;
        pid /run/nginx.pid;
        error_log /dev/stderr info;

        events {
            worker_connections 1024;
        }

        http {
            server_tokens off;
            log_format docker '$remote_addr $remote_user $status "$request" "$http_referer" "$http_user_agent" ';
            access_log /dev/stdout docker;

            charset utf-8;
            keepalive_timeout 20s;
            sendfile on;
            tcp_nopush on;
            client_max_body_size 1M;
            include /etc/nginx/mime.types;

            server {
                listen 80;
                server_name _;

                index index.php;
                root /www;

                location / {
                    try_files $uri $uri/ /index.php?$query_string;
                    location ~ \.php$ {
                        try_files $uri =404;
                        fastcgi_pass unix:/run/php-fpm.sock;
                        fastcgi_index index.php;
                        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                        include fastcgi_params;
                    }
                }
            }
        }
        ```
        Here,
        `user www;`: Nginx runs with the user "www".

        `pid /run/nginx.pid;`: The PID (process ID) file for Nginx is set to "/run/nginx.pid".

        `error_log /dev/stderr info;`: Error logs are redirected to the standard error output with the log level set to "info".

        `events section:`

        `worker_connections 1024;`: Specifies the maximum number of simultaneous connections per worker process.
        http section:

        `server_tokens off;`: Nginx does not reveal its version number in HTTP response headers.
        log_format docker ...;: Defines a custom log format called "docker" for access logs.
        access_log /dev/stdout docker;: Access logs are redirected to the standard output using the "docker" log format.
        Other HTTP-related settings such as character encoding, timeouts, file sending, and maximum client body size are configured.
    ` server block`:

        `listen 80;`: Nginx listens on port 80.
        `server_name _;`: The server responds to any hostname.
    ` index index.php;`: Sets "index.php" as the default index file.
    ` root /www;`: The root directory for serving files is set to "/www".
        `location / block`:

        - Handles requests for the root directory and non-existing files/directories.
        - Tries to find the requested file or directory, and if not found, passes the request to "index.php" with the query string.
    ` location ~ \.php$ block`:

        - Handles requests for PHP files.
        - Checks if the requested file exists and returns a 404 error if not.
        - Passes the request to the PHP-FPM server listening on the Unix socket "/run/php-fpm.sock".
        - Sets the PHP script filename and includes the necessary FastCGI parameters.
    This Nginx configuration sets up the server to listen on port 80, handle PHP requests by passing them to PHP-FPM, define the document root and default index file, and configure logging and other HTTP-related settings.
    - `supervisord.conf` This file is a configuration file for Supervisord, a process control system used to manage and monitor processes on Unix-like systems. Supervisord is often used to manage long-running processes, such as background workers or server components. The supervisord.conf file contains information about the processes to be managed, including their command, environment variables, and logging settings.
    
        ```
        [supervisord]
        user=root
        nodaemon=true
        logfile=/dev/null
        logfile_maxbytes=0
        pidfile=/run/supervisord.pid

        [program:fpm]
        command=php-fpm7.4 -F
        autostart=true
        priority=1000
        stdout_logfile=/dev/stdout
        stdout_logfile_maxbytes=0
        stderr_logfile=/dev/stderr
        stderr_logfile_maxbytes=0

        [program:nginx]
        command=nginx -g 'daemon off;'
        autostart=true
        stdout_logfile=/dev/stdout
        stdout_logfile_maxbytes=0
        stderr_logfile=/dev/stderr
        stderr_logfile_maxbytes=0
        ```
        `[supervisord] section`:

        `user=root`: Specifies that Supervisord should run with root privileges.
        `nodaemon=true`: Runs Supervisord in the foreground instead of as a daemon.
        `logfile=/dev/null`: Sets the log file path to "/dev/null" to discard log output.
    ` logfile_maxbytes=0`: Disables log file rotation based on size.
        `pidfile=/run/supervisord.pid`: Specifies the PID (process ID) file path for Supervisord.
        `[program:fpm] section`:

        ` command=php-fpm7.4 -F`: Sets the command to start PHP-FPM version 7.4 in the foreground.
        `autostart=true`: Specifies that the program should start automatically when Supervisord starts.
        `priority=1000`: Sets the priority of the program.
        stdout_logfile=/dev/stdout and stderr_logfile=/dev/`stderr`: Redirects standard output and standard error to the respective streams.
        `[program:nginx] section`:

        `command=nginx -g 'daemon off;'`: Sets the command to start Nginx with the "daemon off" option.
        `autostart=true`: Specifies that the program should start automatically when Supervisord starts.
    ` stdout_logfile=/dev/stdout and stderr_logfile=/dev/stderr`: Redirects standard output and standard error to the respective streams.

    This Supervisord configuration sets up two programs: PHP-FPM and Nginx. PHP-FPM is started with the "php-fpm7.4 -F" command, while Nginx is started with the "nginx -g 'daemon off;'" command. The configuration specifies that both programs should start automatically, and their output is redirected to the standard output and standard error streams. Supervisord itself runs in the foreground, and its log output is discarded.


4. Here, `Dockerfile` is a file asa Dockerfile used to build a Docker image. Here's a breakdown of each step:

    ```
    FROM debian:buster-slim

    # Setup user
    RUN useradd www

    # Install system packeges
    RUN apt-get update && apt-get install -y supervisor nginx lsb-release wget

    # Add repos
    RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
    RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list

    # Install PHP dependencies
    RUN apt update && apt install -y php7.4-fpm

    # Configure php-fpm and nginx
    COPY config/fpm.conf /etc/php/7.4/fpm/php-fpm.conf
    COPY config/supervisord.conf /etc/supervisord.conf
    COPY config/nginx.conf /etc/nginx/nginx.conf

    # Copy challenge files
    COPY challenge /www

    # Copy flag
    COPY flag /

    # Setup permissions
    RUN chown -R www:www /www /var/lib/nginx

    # Expose the port nginx is listening on
    EXPOSE 80

    # Generate random flag filename and start supervisord
    COPY --chown=root entrypoint.sh /entrypoint.sh
    ENTRYPOINT ["/entrypoint.sh"]

    CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
    ```


    `FROM debian:buster-slim`: Specifies the base image to use, in this case, a slim version of Debian Buster.

    `RUN useradd www`: Creates a new user named "www" inside the container.

    `RUN apt-get update && apt-get install -y supervisor nginx lsb-release wget`: Updates the package index and installs several system packages including supervisor, nginx, lsb-release, and wget.

    `RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg`: Downloads the GPG key for the PHP repository.

    `RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list`: Adds the PHP repository to the system's package sources list.

    `RUN apt update && apt install -y php7.4-fpm`: Updates the package index again and installs PHP 7.4 FPM.

    `COPY config/fpm.conf /etc/php/7.4/fpm/php-fpm.conf`: Copies the fpm.conf file to the appropriate location inside the container.

    `COPY config/supervisord.conf /etc/supervisord.conf`: Copies the supervisord.conf file to the appropriate location inside the container.

    `COPY config/nginx.conf /etc/nginx/nginx.conf`: Copies the nginx.conf file to the appropriate location inside the container.

    `COPY challenge /www`: Copies the challenge files to the /www directory inside the container.

    `COPY flag /`: Copies the flag file to the root directory inside the container.


    `RUN chown -R www:www /www /var/lib/nginx`: Changes the ownership of the /www and /var/lib/nginx directories to the "www" user.

    `EXPOSE 80`: Specifies that the container should listen on port 80.

    `COPY --chown=root entrypoint.sh /entrypoint.sh`: Copies the entrypoint.sh script to the root directory inside the container.

    `ENTRYPOINT ["/entrypoint.sh"]`: Sets the entrypoint for the container to be the entrypoint.sh script.

    `CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]`: Specifies the default command to run when the container starts, which is running supervisord with the supervisord.conf configuration file.
    *This Dockerfile sets up a container with Debian Buster as the base image, installs system packages, adds PHP repositories, installs PHP 7.4 FPM, configures PHP-FPM, Nginx, and Supervisord, copies challenge files and a flag into the container, sets permissions, exposes port 80, and defines an entrypoint and default command for the container.*

There is a [TryHackMe Machine](https://tryhackme.com/room/dockerrodeo) which explains the docker system more clearly with its pentesting methodologies.



5. Now, `entrypoint.sh` is a Bash script that serves as an entrypoint for a Docker container. Here's what each line does:
    ```
    #!/bin/bash

    # Secure entrypoint
    chmod 600 /entrypoint.sh

    FLAG=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 5 | head -n 1)

    mv /flag /flag$FLAG

    exec "$@"
    ```


    `chmod 600 /entrypoint.sh`: Changes the permissions of the entrypoint.sh script to be readable and writable only by the owner.

    `FLAG=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 5 | head -n 1)`: Generates a random string of 5 alphanumeric characters and assigns it to the FLAG variable.

    `mv /flag /flag$FLAG`: Renames the /flag file to /flag followed by the random string stored in the FLAG variable. This effectively changes the name of the flag file to make it less predictable.

    `exec "$@"`: Executes the command provided as arguments to the script. This allows the Docker container to run the specified command or entrypoint from the Dockerfile.

    *This script secures the entrypoint.sh script, generates a random string and renames the flag file accordingly, and then executes the provided command or entrypoint.*

    
6. Lastly, file `flag` provides the flag for testing which changes randomly due as commanded by the programs above.

Overall, the details provided include a Dockerfile and a Bash script used in the context of a web application deployment. The Dockerfile sets up a Docker image based on Debian Buster, installing system packages like Supervisor, Nginx, and PHP 7.4 FPM, configuring them, and copying necessary files. The Bash script serves as the entrypoint for the Docker container, securing the entrypoint script, renaming the flag file with a random string, and executing the provided command or entrypoint. These components work together to create a containerized environment for running the web application in order to allow us to test  it.