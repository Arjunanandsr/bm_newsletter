# News letter sign up

How to test :

# Config

Change Db and Mail settings

# Migration 

Run this : `php artisan migrate`


# Queue Execution

For testing purpose QUEUE_CONNECTION is in sync mode.

We can change to QUEUE_CONNECTION=database to make the queue function in background.

Run this : `php artisan queue:work`

# To Test the App 

git url : https://github.com/Arjunanandsr/bm_newsletter
Change env.example to .env Change Mailer and DB and Queue Setting
composer install
Create the Schema
php artisan migrate
php artisan serve

# App URLS 
Newsletter Mail Sign Up :  http://127.0.0.1:8003/susbscribe
Newsletter Mail Send    : http://127.0.0.1:8003/newsletter