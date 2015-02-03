#!/bin/sh
echo -e "\033[32m -------- Installing --------"
echo "Resetting migrations:"
php artisan migrate:reset
echo "Clearing cache:"
php artisan cache:clear
echo "Running migrations:"
php artisan migrate --package=cartalyst/sentry --env=local
php artisan migrate --env=local 
echo "Seeding database:"
php artisan db:seed --env=local
echo -e "\033[32m -------- \033[31m√ \033[32mInstallation Complete --------"