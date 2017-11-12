# laravel-shared-multitenancy
Example of a shared multitenancy data model using Laravel and MySQL

## Installing
1. Install docker if you don't have it https://www.docker.com
2. Clone repo locally and cd into the project
3. Start the docker container
> make docker-start
5. SSH into the docker container
> ./ssh.sh
6. Migrate and seed
> php artisan migrate:fresh
> php artisan db:seed

## Usage
1. Connect to MySQL shell:
> ./mysql.sh
2. Grab an email address from the users table
> select email from users limit 5;
3. Visit http://localhost:8000/ and click login
4. Use the email address with the password "secret"

## MySQL credentials
>* host: 127.0.0.1
>* port: 3306
>* username: dev
>* password: dev
>* database: test

### Disclaimer
This project is meant to showcase a relational data model and Laravel Eloquent implementation for shared multitenancy.  It is not meant to be run in a production environment without significant changes.