#!/bin/bash

# Wait for PostgreSQL to be available
echo "Waiting for PostgreSQL..."
while ! nc -z $DB_HOST $DB_PORT; do
    sleep 1
done
echo "PostgreSQL is up!"

# Run migrations
php artisan migrate --force

# Start Nginx and PHP-FPM
echo "Starting Nginx and PHP-FPM..."
service nginx start
php-fpm
