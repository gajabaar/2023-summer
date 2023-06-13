#!/bin/bash

sqlite3 gwitter.db < database/schema.sql
sqlite3 gwitter.db < database/populate.sql
chmod 777 gwitter.db

echo "Success"