Installation.

Clone the repo locally:
https://github.com/fabiovettori/gad

Install PHP dependencies:
composer install

Install NPM dependencies:
npm install

Build assets:
npm run dev

Setup configuration:
clone file .env and rename it as follow .env.example
in the original .env file  set:

DB_DATABASE= (naming as you like)
DB_USERNAME=root
DB_PASSWORD=root

Generate application key:
php artisan key:generate

Create a database (I suggest to use MAMP and phpMyAdmin)
chose the same name as you chosen for DB_DATABASE

Run database migrations:
php artisan migrate

Run database seeder:
php artisan db:seed  --class=DatabaseSeeder

Run the dev server (the output will give the address):
php artisan serve

You're ready to go! Fill in the fields and register.



Regards, Fabio.