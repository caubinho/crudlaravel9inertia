
## Crud with Laravel 9 Inertia

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Laradock

Quick Overview
Let’s see how easy it is to setup our demo stack PHP, NGINX, MySQL, PhpMyAdmin, Redis and Composer:

1 - Clone Laradock inside your PHP project:

git clone https://github.com/Laradock/laradock.git
2 - Enter the laradock folder and rename .env.example to .env.

cp .env.example .env
3 - Run your containers:

docker-compose up -d nginx mysql phpmyadmin redis workspace
4 - Open your project’s .env file and set the following:

DB_HOST=mysql

REDIS_HOST=redis 

QUEUE_HOST=beanstalkd

## Viteconfig

export default defineConfig({

server: {
     hmr: {
         host: 'Your-Url.com'
     }
},

## Package.json

"scripts": {
"dev": "vite  --host 0.0.0.0",
},




