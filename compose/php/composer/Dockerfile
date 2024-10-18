FROM composer:latest

WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to the working directory
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev