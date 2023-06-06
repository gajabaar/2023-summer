#!/bin/ash

cat database/schema.sql | sqlite3 database/gwitter.db

sqlite3 database/gwitter.db