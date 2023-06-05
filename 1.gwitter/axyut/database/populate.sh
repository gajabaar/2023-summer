#!/bin/bash

sqlite3 gwitter.db < database/schema.sql
sqlite3 gwitter.db < database/populate.sql

echo "Success"