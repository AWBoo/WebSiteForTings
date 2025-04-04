# Use an official PHP runtime as a parent image
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git libxml2-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql bcmath opcache

# Set working directory
WORKDIR /var/www

# Copy the existing application directory contents into the container
COPY . .

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 8080 (default for Laravel)
EXPOSE 8080

# Set the command to run your app
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
