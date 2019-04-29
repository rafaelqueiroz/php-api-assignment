FROM php:7.3-apache

COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN apt-get update
RUN apt-get install -y apt-utils libmcrypt-dev g++ libicu-dev libmcrypt4 zlib1g-dev git libz-dev libmemcached-dev curl
RUN docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN apt-get purge --auto-remove -y libmcrypt-dev g++ libicu-dev zlib1g-dev
RUN rm -rf /var/lib/apt/lists/*
RUN curl -sSL https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN a2enmod rewrite
RUN usermod -u 1000 www-data
RUN apachectl restart