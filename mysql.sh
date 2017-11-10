#!/usr/bin/env bash
export $(cat .env | sed -e /^$/d -e /^#/d | xargs) &&
docker-compose run mysqldb mysql -h $DB_HOST $DB_DATABASE -u$DB_USERNAME -p$DB_PASSWORD