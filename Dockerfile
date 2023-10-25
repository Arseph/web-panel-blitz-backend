# Development
# Author Sursill

FROM php:7.4-apache

WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
zip \
unzip \
git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY composer.lock* composer.json* /var/www/html/
COPY . /var/www/html
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port 8000
EXPOSE 8000