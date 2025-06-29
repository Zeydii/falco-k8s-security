FROM php:7.4-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Copy application files to the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
