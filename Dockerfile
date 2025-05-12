# Use official PHP with Apache
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (optional but useful)
RUN a2enmod rewrite

# Copy source code to web root
COPY . /var/www/html/
