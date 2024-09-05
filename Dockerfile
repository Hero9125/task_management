# Use an official PHP image with FPM 
FROM php:8.2-fpm


# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Composer globally (multi-stage build)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents to the container
COPY . /var/www

# Install Laravel dependencies via Composer
RUN composer install --no-scripts --no-dev --prefer-dist

# Set file and folder permissions for Laravel (important for caching, logging)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Expose port 9000 for php-fpm
EXPOSE 9000

# Start php-fpm server
CMD ["php-fpm"]
