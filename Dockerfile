####FROM ubuntu:16.04
####MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
####
##### Install prerequisites
####RUN apt-get update && apt-get install -y \
####curl
#####RUN apt-get update && apt-get add bash
####
#####
#####
####FROM php:7.2.25-cli
####MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
#####
######RUN apt-get install php7.2-curl
#####
######COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
#####COPY start-apache /usr/local/bin
#####
#####COPY . . /var/www/
#####RUN chown -R www-data:www-data /var/www
#####
#####
#####
#####CMD ["index.php"]
####
####
####FROM php:7.2.25-cli
####MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
####
##### set a directory for the app
####WORKDIR /var/www/crawler/
####
#####Install git
####RUN  apt-get update && \
####     apt-get install -y git
#####RUN docker-php-ext-install pdo pdo_mysql mysqli
#####RUN a2enmod rewrite
#####Install Composer
####RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
####RUN php composer-setup.php --install-dir=. --filename=composer
####RUN mv composer /usr/local/bin/
####
####
####COPY . .
####RUN chown -R www-data:www-data /var/www/crawler/
####
####EXPOSE 80
####
###
#### start from base
###FROM ubuntu:18.04
###
###MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
###
#### install system-wide deps for python and node
###RUN apt-get -yqq update
###RUN apt-get -yqq install python3-pip python3-dev curl gnupg
###RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
###RUN apt-get install -yq nodejs
###
#### copy our application code
###ADD flask-app /opt/flask-app
###WORKDIR /opt/flask-app
###
#### fetch app specific deps
###RUN npm install
###RUN npm run build
###RUN pip3 install -r requirements.txt
###
#### expose port
###EXPOSE 5000
###
#### start app
###CMD [ "python3", "./app.py" ]
###
###
###
###RUN apt-get update -y && apt-get install -y software-properties-common language-pack-en-base
###
###RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
###
###RUN apt-get -y update && apt-get install -y \
###    php7.0 \
###    php7.0-pgsql \
###    php-pear \
###    php7.0-curl \
###    php7.0-xml \
###    php7.0-bcmath \
###    php7.0-zip \
###    php7.0-mbstring \
###    php-xdebug \
###    php-ast \
###    php-ast
###
###WORKDIR /var/www/html/code
##
##
##FROM php:7.4-cli
##
##COPY . .
##
##WORKDIR /usr/src/crawler
##
##CMD [ "php", "index.php" ]
#
#
#
### Base image
##FROM php:7.2-apache
##
### Fix debconf warnings upon build
##ARG DEBIAN_FRONTEND=noninteractive
##
### Run apt update and install some dependancies needed for docker-php-ext
##RUN apt update && apt install -y apt-utils   git \
##  curl
##
#### Install PHP extensions
###RUN docker-php-ext-install mysqli bcmath gd intl xml curl pdo_mysql pdo_sqlite hash zip dom session opcache
###
#### Update web root to public
#### See: https://hub.docker.com/_/php#changing-documentroot-or-other-apache-configuration
###ENV APACHE_DOCUMENT_ROOT /var/www/html/public
###RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
###RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
##
##RUN cli
### Enable mod_rewrite
##RUN a2enmod rewrite
#
#
## Dockerfile.development
##FROM php:7-apache
##MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
##
### Setup Apache2 config
##COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
##RUN a2enmod rewrite
##
### use your users $UID and $GID below
##RUN groupadd apache-www-volume -g 1000
##RUN useradd apache-www-volume -u 1000 -g 1000
##
##CMD ["apache2-foreground"]
#
#
##FROM php:7-apache
##MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
##
##
###COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
##
##COPY start-apache /usr/local/bin
##RUN start-apache
##
### Copy application source
##COPY . . /var/www/crawler/
##RUN chown -R www-data:www-data /var/www/crawler/
##
##CMD ["index.php"]
#
#
#FROM ubuntu:18.04
#
#MAINTAINER LayiriBatiene <eratos02@yahoo.fr>
#
#EXPOSE 80
#ENV TZ=Europe/Kiev
#
#RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
#RUN apt-get update
#RUN apt-get upgrade -y
#RUN apt-get install -y libapache2-mod-php7.2 php7.2 php7.2-cli php7.2-gd php7.2-intl php7.2-mbstring php7.2-mysql php7.2-xml php7.2-xsl php7.2-bcmath php7.2-zip php-apcu npm lynx
#RUN apt-get install -y mysql-client composer screen tmux vim nano iputils-ping
#
#
#ENTRYPOINT service apache2 restart && bash

FROM php:7.2.25-apache
COPY . .  /var/www/html/
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
EXPOSE 80
