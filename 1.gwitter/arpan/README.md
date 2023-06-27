# Application : Gwitter

### General Overview :

The application contains a functionality to signup using username and password. The username should be different to each user . If successfully signed up , it redirects to login.php . We can login there and it checks username and password. If user enters wrong password for more than 5 times then , he/she cant login for next 60 seconds . After logging in , we will be redirected to profile.php where we can view gweets and gweet . We can view comments and comment on gweet  as well.

## Running Docker
Once you have cloned the repository , go to its location and give execute permission to ``` build-docker.sh``` by command:

``` sudo chmod +x build-docker.sh ```

Then you can run the docker by command :

``` sudo ./build-docker.sh```

You can access the application by browsing to  http://localhost:8080