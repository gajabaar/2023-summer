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

4. **Followers** : 

   This table is used for looking followers of an user.
* followers_id = id of people who follows user 

5. **Followings** : 

   This table is used for looking followings of an user.
* following_id = id of people whom user is following

```data.sql```

It has the dummy data for the database.

``` Note: ``` The database design is slightly changed during the building of this application and the ```gwitter.db``` is loaded with different data than mentioned in data.sql.

The installation , reading sql file and populating with database can be found [here.](../database/README.md)

# Week 2. PHP
In this week , I wrote a simple application named 
gwitter in php  . It includes the functionality to 
signup , login , see gweets of every user, comment on 
the gweets and logout from the application . There is 
respective php files for each functionality.

The files developed are :

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

``` functions.php ``` : It has the functions which 
are called on other pages.

``` gwitter.db ``` : It is the database of the 
application .


# Week 3. CSS and Docker
CSS was added to all the files to make the 
application a bit more beautiful . Different CSS 
files are made for each pages . 

## Docker
I made two docker files named ```Dockerfile``` and 
```build-docker.sh```

``` Dockerfile ``` : 
- It uses the php:latest base image.
- It installs the libsqlite3-dev package for SQLite3 
support.
- Package lists are updated and then removed to 
reduce the image size.
- The SQLite3 extension for PHP is installed.
- The working directory inside the container is set 
to /var/www/html.
- Application files are copied into the container.
- The command to start the PHP built-in web server is 
set as php -S 0.0.0.0:80 -t .

``` build-docker.sh``` :
- It removes any existing Docker container with the 
name **arpan_gwitter**
- It builds a Docker image named **arpan_gwitter** 
using the Dockerfile in the current directory. 
- It then creates a Docker volume named 
**arpan_gwitter-data** for storing the database file.
- Finally, it starts a Docker container with the 
image **arpan_gwitter**, maps port 8080 on the host 
to port 80 in the container, and mounts the 
**arpan_gwitter-data** volume to the "/var/www/html/
database" directory in the container.

# Week 4 . Openvas
The task was to scan the gwitter app from Openvas and manual testing. 
### I tested the application developed by [Nischhal](https://github.com/gajabaar/2023-summer/tree/main/1.gwitter/nischhal).

Commit Hash : ```7559be9```

- Setup local instance of OpenVAS using docker.

```bash
docker pull mikesplain/openvas
```

- run the container

```bash
docker run -d -p 443:443 --name openvas mikesplain/openvas
```

I tested the application through openvas and some manual testing as well and found some vulnerabilities.  The findings of the application is [here](https://paudelarpan.notion.site/paudelarpan/Gwitter-OpenVAS-4899ac8398184d5395bd3c80e7cddfe9).

# Week 5 . Web Security Lab

- For the Web Security lab I did the Access Control Vulnerabilities lab. The lab solution is repoted [here](https://paudelarpan.notion.site/paudelarpan/Access-control-vulnerabilities-52cd8ec15dee41cf8237bcbf651e3220).