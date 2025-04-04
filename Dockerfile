# Use PHP 8.2 base image
FROM php:8.2-fpm

# Install system dependencies (e.g., curl, libpng, etc.) and Nginx
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip git unzip nginx \
    libpq-dev \
    nodejs \
    npm && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && docker-php-ext-install pdo_pgsql pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy project files into container
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Create the symbolic link for Laravel's storage directory
RUN php artisan storage:link

# Set correct permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Configure Nginx (optional, can add your own config if needed)
COPY nginx/default.conf /etc/nginx/sites-available/default

# Expose port 8080 (default for Laravel)
EXPOSE 8080

# Start both Nginx and PHP-FPM
CMD service nginx start && php-fpm
