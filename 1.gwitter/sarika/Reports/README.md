# Week 1.   SQLITE
For this week , we had to design a database in sqlite3 for our application Gwitter.

## Database Design
I created the following tables for the database used only for testing and data will be different in the production:

```schema.sql```

1. **Users** : 

   This table is used when user signup , signin or login.
* user_id = unique for each user , integer , auto increment
* username = unique for each user
* password = password of each user

2. **Gweet** : 

   This table is used to gweet and view them.
* gweet_id = unique for each gweet
* gweet= content of gweet
* user_id = foreign key

3. **Comment** : 

   This table is used to store the comments on gweet and view them.
* comment_id = unique for each comment
* comment = to store the comments
* user_id and gweet_id


# Week 2. PHP
In this week , I wrote a simple application named 
gwitter in php  . It includes the functionality to 
signup , login , see gweets of every user, comment on 
the gweets. There is respective php files for each functionality.

The files developed are arranged in respective relevant folder like: authentication, database, profile and so on.

``` index.php ``` : It has the interface for login 
and user gets redirected to this if he/she isn't 
logged in.

``` login.php ``` : It has the functionality to 
verify the username and password and display message 
if username or password is invalid.

``` signup.php ```: It has the interface for signup 
and also the functionality to verify if the username 
has been already taken and display message . It also 
redirects to login.php when registration is 
successfull and displays message too .

``` profile.php ``` : It has the functionality to 
display gweets of all the users . Also an user can 
post a gweet as well.  We can click on View Comments 
which redirects us to comments.php.

``` comments.php ``` : It has the functionality to 
display all the comments of that particular gweet . 
Also an user can comment as well.

``` handler.php ``` : It has the functions which 
are called on other pages.

``` gwitter.db ``` : It is the database of the 
application .


# Week 3. CSS and Docker
CSS was added to all the files to make the 
application a bit more user-friendly. Different CSS 
files are made for each pages. 

## Docker
I made two docker files named ```Dockerfile``` and 
```build-docker.sh```

``` Dockerfile ``` : 

Here's what the dockerfile does: 

- Base image: PHP 7.4 CLI

- Install SQLite3

- Set working directory to /usr/src/app

- Copy project files to container

- Create SQLite database using schema.sql

- Expose port 8000

- Start PHP built-in server on 0.0.0.0:8000

``` build-docker.sh``` :

Here's what this script does: 

- Remove existing "gwitter-app" container if it exists.

- Build a Docker image named "gwitter-app" from the current directory.

- Create a Docker volume named "gwitter-app-data" for the database file.

- Start a new container named "gwitter-app," exposing port 8000, and mount the "gwitter-app-data" volume to the container's database directory.

# Week 4 . Openvas
The task was to scan the gwitter app from Openvas and manual testing. 
### I tested the application developed by [Arpan](https://github.com/gajabaar/2023-summer/tree/main/1.gwitter/arpan).


- Setup local instance of OpenVAS using docker.

```bash
docker pull mikesplain/openvas
```

- run the container

```bash
docker run -d -p 443:443 --name openvas mikesplain/openvas
```

I tested the application through openvas and trivy plus some manual testing as well and found some vulnerabilities.  The findings of the application is [here](https://little-check-f2f.notion.site/Gwitter-Test-77f4df9e7dfa4eea9fad6db3c43e1b42).

# Week 5 . Web Security Lab

- For the Web Security lab I did the CSRF[Cross Site Request Forgery] labs from Portswigger Academy. The lab solution is repoted [here](https://little-check-f2f.notion.site/CSRF-Cross-site-Request-Forgery-a1d1e1a2e65f47f593bbcfaa4994a0f9).