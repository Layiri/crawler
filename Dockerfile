
FROM php:7.2.25-cli

WORKDIR /usr/src/myapp
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM php:7.4-cli
RUN apt-get update \
    && pecl install xdebug-2.8.1 \
    && docker-php-ext-enable redis xdebug

apt-get update; l
