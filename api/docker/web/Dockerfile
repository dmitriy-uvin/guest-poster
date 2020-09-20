FROM php:7.4-apache

RUN apt-get update && \
  a2enmod rewrite && \
  docker-php-ext-install mysqli pdo pdo_mysql

COPY default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app
RUN chmod -R 755 /var/www/app

EXPOSE 80
