FROM php:8.2-apache as build

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y git unzip zip iputils-ping libldap2-dev

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache ldap

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

FROM build as web

# Giphy API Key
ENV GIPHY_API_KEY=giving_by_docker_image

RUN useradd -rm -d /home/1000 -s /bin/bash -g root -G sudo -u 1000 1000
USER 1000