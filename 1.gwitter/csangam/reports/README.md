## Week 1 - SQLite Essentials
The goal this week is to get working idea on what a database system is,
and how it works. For this, we have picked SQLite, primarily because
it's light-weight and easy to get up and running.

A database for Gwitter is designed and implemented. Files containing the
sql statements for creating the database `Gwitter.sql` and for populating the
database with data are created `data.sql` 

### Week 2 - PHP Essentials
- PHP fundamentals (how it generates dynamic content)
- PHP interactions (how it processes form data)
- PHP infrastructure (how it connects to a database service)
- Introduction to PHP interpreter

### Week 3 - Gwitter
Complete Gwitter Application is developed and containerized. Run the application by running build-docker.sh 
```bash
bash build-docker.sh
```

# Week 4 . Openvas
The task was to test for security vulnerabilities in gwitter app

I tested the application developed by [Arpan](https://github.com/gajabaar/2023-summer/tree/main/1.gwitter/arpan).

Commit Hash : ```04a04ee```

- Setup local instance of OpenVAS using docker.

```bash
docker pull mikesplain/openvas
```

- run the container

```bash
docker run -d -p 443:443 --name openvas mikesplain/openvas
```

[Testing Report](https://csangam.notion.site/csangam/OpenVAS-2a4189ba553d48d0b5bb083ea2f50af7)
 
# Week 5 . Web Security Lab

I completed the CSRF lab

[Lab Report](https://csangam.notion.site/csangam/CSRF-1fd790415cdb48bf90868e832a84c94b)