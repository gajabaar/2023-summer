One the first module, you will build an application of your own.
The application will be similar in feature to twitter,
but we will call it gwitter.
Your users will be able to sign up, sign in and sign out.
Once signed in, they will be able to follow other users.
On their home page, they will be able to see the feed
of tweets from people that they follow.
Your users should also be able to see their own profile
and tweets.

## Objective

Get familiar with the web technology and the development process.

## Tasks

### Week 1 - SQLite Essentials
The goal this week is to get working idea on what a database system is,
and how it works. For this, we have picked SQLite, primarily because
it's light-weight and easy to get up and running.

Your task is to design and implement a database for Gwitter.
You will need to think about what information you want to store,
then write SQL statements to create database that will store
this information.

### Week 2 - PHP Essentials
For this week, take some time to explore php. 
Start working on user sign up, sign in, sign out.
Figure out how to connect to a database using PHP
and use it.

### Week 3 - Gwitter
This is an additional week to continue work on Gwitter,
perhaps add a CSS framework to make it look prettier,
perhaps add a feature that you think would be cool,
perhaps do some bug fixes.

Keep in mind that by the end of this week,
you will also need to provide a Dockerfile
that will install and run your application.

### Week 4 - Vulnerability Scanning w/ OpenVAS
This week, we will ask you to pair with someone and 
do a security scan of their application using openvas.
Then pick a vulnerability that openvas reports (or doesn't report
but you know from reading their source code that it's a vulnerability)
then do a deep dive on how you can exploit that vulnerability.

We will release instructions over discord on how to pair with someone.

## Resources
[Week 1 - SQLite Essentials]
- Likely, you will need the following tables for your application.
    - User (username, password)
    - followed\_by (username, follows)
    - Gweet (username, gweet)
- [Installing and Using SQLite on Ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-sqlite-on-ubuntu-20-04)
- [SQLite Documentation](https://www.sqlite.org/docs.html)
- [SQL Playground](https://www.db-fiddle.com/)
- During meeting this week, we will go over sqlite ourselves to look
at a high level overview

[Week 2 - PHP Essentials]
- [PHP Manual](https://www.php.net/manual/en/intro-whatis.php)
- [PHP Tutorial](https://www.w3schools.com/php/)
- The meeting this week will cover Getting Started with PHP.

[Week 3 - Gwitter]

[Week 4 - Vulnerability Scanning w/ OpenVAS]
- [Source Repository](https://github.com/greenbone/openvas-scanner)
- [OpenVAS Docker Container](https://hub.docker.com/r/greenbone/openvas-scanner)
- The meeting this week will cover getting started with OpenVAS

## Submission

You are expected to submit a progress report at the end of each week.
Work on a branch on the format `git checkout -b task1/week1` and
send this in for pull request. All files are expected to be inside
a folder with your username, same as previous tasks.

- Week 1: Submit a report detailing your database design and why you
have designed it that way. The report should be inside `reports` folder.
Also submit .sql with SQL statements that can be run without errors 
to create and populate this database with some test data. 
- Week 2: Submit a report on your progress along with the code you
wrote this week. 
- Week 3: Submit a report on your progress along with the code you
wrote this week.
- Week 4: Submit a report detailing the vulnerabilities you found
and vulnerabilities you chose to do a deep dive on.

One possible final organization of files is as follows
- /1.gwitter/bhakku
    - /database
        - README.md (details your database design and how to run the sql files)
        - users.sql
        - gweets.sql
    - /reports
        - README.md [has sections for week1, week2, ...]
    - home.php
    - profile.php
    - Dockerfile
    - build\_docker.sh
    - README.md (describe the general application, installation, usage)

## Miscellaneous

We recommend doing the Advent of Cyber room on Try Hack Me from the
past year to have general ideas on fundamental web security issues.

We also recommend working on overthewire natas wargame.
