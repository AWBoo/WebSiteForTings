#!/bin/bash

# Wait for the database to be available
until nc -z -v -w30 $DB_HOST $DB_PORT; do
    echo "Waiting for database connection..."
    sleep 1
done

# Run Laravel migrations
php artisan migrate --force

# Start PHP-FPM and Nginx
service php8.2-fpm start
service nginx start

# Keep the container running
tail -f /dev/null