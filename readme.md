## GraphQL Laravel Vue Postgresql Docker Codeception

### Description
### How to run this project

To run this project you need to have docker and docker-compose installed in your machine.

Take the following steps:

- clone repository: 'git clone https://github.com/Dini108/graphql-laravel-pgsql-vue'
- change directory: 'cd graphql-laravel-pgsql-vue'
- run command: 'docker-compose pull'
- run command: 'docker-compose up -d'
- run command: 'cd src'
- run command: 'npm install'
- run command: 'docker exec -it laravel bash'
- run command: 'composer install'
- create an '.env' file from '.env.example'  
- run command: 'php artisan key:generate'
- run command: 'php artisan migrate'
- run command: 'php artisan db:seed'

Webpage path: http://localhost

To run acceptance tests:
(inside docker container)
- php vendor/bin/codecept run acceptance --steps --env=chrome