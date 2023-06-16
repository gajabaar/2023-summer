# Gwitter
This is a twitter clone made as a part of an assignment. Using php, sqlite and docker as the core focus technologies.

## How to use
1. make build
2. make run
3. visit `localhost:5001`

## Database
I have made 3 databases:
- `Users` to store the information of created user accounts.
- `Gweets` to store the individual gweets and replies.
- `Reply` to store the parent child relation of Reply Gweets.

The database is created by the dockerfile.

## Docker
The project uses docker for reproducible build.

It does the following.

1. Inherits php:8.2-apache
2. Changes working directory and copies stuff.
3. Creates a database file.
4. Adds write permission to it.
5. Updates the repo and installs sqlite.
6. Use sqlite to generate the schema.
7. Make the php process chown the files.
8. Put a SALT.