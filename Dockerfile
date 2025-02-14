# Use PHP with Apache
FROM php:8.1-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set the PHP timezone
RUN echo "date.timezone = 'UTC'" > /usr/local/etc/php/conf.d/timezone.ini

# Set the working directory
WORKDIR /var/www/html

# Copy composer.json and composer.lock (if they exist)
COPY composer.json composer.lock ./

# Debug: List files in the working directory
RUN ls -la

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring

# Copy the rest of your PHP project files
COPY . .

# Expose port 80 for Apache
EXPOSE 80


# Start Apache in the foreground
CMD ["apache2-foreground"]