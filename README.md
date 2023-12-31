<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## NGO Employment

## Install dependencies
<p>
Have the composer installed: https://getcomposer.org/
</p>
<p>
Install or update Laravel dependencies using "composer install" or "composer update" in a console open at the project root</p>

<p>
Install or update front end dependencies using "npm install" in a console open in the project root</p>

## Configure database
<p>
Create a database in the MySQL engine and call it from the root .env file, filling in the following parameters</p>

<p align="center">
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>
</p>

<p>
Finally run the command "php artisan migrate --seed" in a console in the root of the project, to generate the migrations of the db and records</p>

## Admin user
<p>
Access as admin to the application is as follows

login: admin@ngoemployment.com

Password: password123
</p>

<p>To have a user as a person or company, follow the registration steps in /login</p>

