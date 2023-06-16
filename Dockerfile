# Use the base PHP image
FROM php:7.4-apache

# Working directory inside the container
WORKDIR /var/www/html

# Copy project files to the container
COPY . /var/www/html

# Install PHP dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache module for URL rewriting
RUN a2enmod rewrite
