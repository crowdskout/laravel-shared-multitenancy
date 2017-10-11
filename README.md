# laravel-shared-multitenancy
Example of a shared multitenancy data model using Laravel and MySQL

## Installing
1. Clone repo locally
2. Install docker if you don't have it https://www.docker.com
3. In the repo directory
> make docker-start
4. Add this to your /etc/hosts file
> 127.0.0.1 mysql
5. In the repo directory (php 7 needs to be installed)
>* php artisan migrate:fresh
>* php artisan db:seed

## Usage
1. Connect to MySQL:
>* host: 127.0.0.1
>* port: 3306
>* username: dev
>* password: dev
>* database: test
2. Grab an email address from the users table
3. Visit http://localhost:8000/ and click login
4. Use the email address with the password "secret"