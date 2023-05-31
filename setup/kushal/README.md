# HackTheBox LoveTok Challenge 'Lovetok'

This report provides an overview of the setup and configuration of the HackTheBox web challenge machine called LoveTok using Docker.

## Downloading the Challenge Files

1. Login to your HackTheBox account.
2. Navigate to the LoveTok challenge page.
3. Download the challenge files provided in a zip format.
4. Extract the zip file using the provided password "hackthebox".

![Alt text](./assets/Download_files.png?raw=true "Download file")

## Challenge Files Structure

After extracting the zip file, you will find the following files and folders:

![Alt text](./assets/Folder_content.png?raw=true "File Structure")

- `build_docker.sh`: A bash script for building and running the Docker container.
- `challenge/`: Folder containing the source code for the LoveTok web application.
- `config/`: Directory containing configuration files for PHP-FPM, Nginx, and Supervisord.
- `Dockerfile`: Dockerfile used to build the Docker image.
- `entrypoint.sh`: Bash script serving as the entrypoint for the Docker container.
- `flag`: File containing the challenge flag.

## Understanding the Configuration Files

### `Dockerfile`

The Dockerfile is used to build the Docker image for the LoveTok challenge machine. It includes the following steps:

- Uses a Debian Buster slim image as the base image.
- Installs system packages such as supervisor, nginx, lsb-release, and wget.
- Adds the PHP repository and installs PHP 7.4 FPM.
- Copies the PHP-FPM, Nginx, and Supervisord configuration files to their respective locations inside the container.
- Copies the challenge files to the `/www` directory.
- Sets permissions and exposes port 80.
- Specifies the entrypoint script and default command for the container.

### `entrypoint.sh`

The entrypoint.sh script serves as the entrypoint for the Docker container. It performs the following actions:

- Changes the permissions of the entrypoint.sh script to be readable and writable only by the owner.
- Generates a random string of 5 alphanumeric characters and assigns it to the `FLAG` variable.
- Renames the `flag` file to `flag$FLAG` to make the flag file name less predictable.
- Executes the command provided as arguments to the script, allowing the Docker container to run the specified command or entrypoint from the Dockerfile.

### Configuration Files in `config/`

The `config/` directory contains configuration files for PHP-FPM, Nginx, and Supervisord. Here's a breakdown of each file:

- `fpm.conf`: Configuration file for PHP-FPM (FastCGI Process Manager). It defines various settings related to PHP-FPM's behavior, such as the number of worker processes, process priorities, and resource limits.
- `nginx.conf`: Configuration file for Nginx, the web server and reverse proxy server. It defines how Nginx handles incoming HTTP requests, serves static and dynamic content, and includes various directives related to server behavior, caching, SSL/TLS configuration, and proxying.
- `supervisord.conf`: Configuration file for Supervisord, a process control system used to manage and monitor processes on Unix-like systems. It specifies the processes to be managed, including their commands, environment variables, and logging settings.

## Building and Running the Docker Container

To build and run the LoveTok challenge machine using Docker, follow these steps:

1. Open a terminal and navigate to the extracted challenge files directory.
2. Run the `build_docker.sh` script using the following command:
   ```bash
   ./build_docker.sh
   ```
   This script removes any existing Docker container named "lovetok", builds a Docker image named "lovetok" based on the Dockerfile, and runs a new Docker container named "lovetok

.