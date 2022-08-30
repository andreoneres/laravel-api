# Base image
FROM php:8.1.8-apache

# Define work directory
WORKDIR /var/www

# Copy the files to the directory that apache will serve
COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install

# Configure storage folder permissions
RUN chmod -R 733 ./storage

# Install postgres
RUN apt-get update

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Configure apache2
RUN echo "ServerName localhost:8080" >> /etc/apache2/apache2.conf

COPY apache-site.conf /etc/apache2/sites-available

RUN a2ensite apache-site.conf
RUN a2dissite 000-default.conf
RUN a2enmod rewrite

RUN service apache2 restart

# Expose port to access
EXPOSE 80
