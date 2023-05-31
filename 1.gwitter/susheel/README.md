# Gwitter

In this section, we will be creating our own **Gwitter database**.

The entity diagram of the database we will be building is shown below:

![Gwitter Database](./assets/gwitter_database.png)

We will be using **SQLite3** database.
[comments.sql](database%2Fmodels%2Fcomments.sql)
## Installation of `sqlite3` in linux

[*You can skip this section if you are populating the database inside Docker Container*]

I have prepared a script file for your easiness while installing `sqlite3`

You can run the script file as

```bash
bash install_sqlite3.sh
```

Note:
_Make sure that you are inside the `susheel` folder of `1.gwitter` folder._

## Populating the database(Locally)

To populate the database I have created another script file named `populate_database.sh` inside database folder.

You can just run command below to generate the database and populate the database.

```bash
cd database
bash populate_database.sh
cd ../
```

If you are interested on how databases is generated i.e how individual table are generated then you can refer [here](./database/README.md).

## Populating the database(Docker Container)

Populating the database inside the Docker container is supereasy. As I have already written the need [Dockerfile](./Dockerfile)to populate the database and its data.

Run the below command in the terminal to populate the docker file inside the Docker Container.

```bash
bash build_docker.sh
```

## Testing the populating database

After we have populate the database either locally or Docker container, we need to test if it has been populated properly or not.

If you have populated the database locally then open the terminal and navigate to `1.gwitter/susheel` folder.

If you have populated the database in Docker container then when the `bash build_docker.sh` command finshed executing you will be directly access to terminal of the Docker container.

You can run below query to see if you output is also same.

- Query Zero

  ```sql
  .table
  ```

  ```text
  COMMENTS    FOLLOWINGS  LIKES       REPOST      USERS
  FOLLOWERS   GWEETS      MESSAGES    SHARE
  ```

- Query One

  ```SQL
  SELECT * FROM USERS LIMIT 5;
  ```

  ```TEXT
  1|jtomblings0|cqu4YH3UrX|2023-05-31 00:41:24
  2|emonument1|EWf4DMwL|2023-05-31 00:41:24
  3|byendle2|EinUFFy8|2023-05-31 00:41:24
  4|askipperbottom3|AAE3rp7YwBtQ|2023-05-31 00:41:24
  5|jitzkov4|e4P3MvNy|2023-05-31 00:41:24
  ```
