FROM php:7-apache

# Fix Permission problem workaroud
# http://chapeau.freevariable.com/2014/08/docker-uid.html
RUN ["useradd", "-u", "1000", "-m", "-s", "/bin/bash", "dockerdev"]
RUN chown -R 1000:50 $(cat /etc/passwd | grep dockerdev | cut -f6 -d:)

RUN apt-get update -qy \
    && apt-get install -y git-core \
    wget \
    less \
    unzip \
    mysql-client \
    libsqlite3-0 \
    sqlite3


# Install
RUN buildDeps=" \
        libpng12-dev \
        libjpeg-dev \
        libmcrypt-dev \
        libxml2-dev \
        libicu-dev \
        freetype* \
        libsqlite3-dev \
    "; \
    set -x \
    && apt-get install -y $buildDeps --no-install-recommends && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure \
        gd --with-png-dir=/usr --with-jpeg-dir=/usr --with-freetype-dir \
    && docker-php-ext-install \
    gd \
    mbstring \
    mcrypt \
    intl \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    soap \
    zip \
    json \
    opcache \
    && cd /tmp/ && git clone https://github.com/derickr/xdebug.git \
    && cd xdebug && phpize && ./configure --enable-xdebug && make \
    && mkdir /usr/lib/php5/ && cp modules/xdebug.so /usr/lib/php5/xdebug.so \
    && touch /usr/local/etc/php/ext-xdebug.ini \
    && rm -r /tmp/xdebug

##########
# APCu
##########
RUN pear config-set php_ini /usr/local/etc/php/php.ini
RUN pecl config-set php_ini /usr/local/etc/php/php.ini
RUN pear config-set http_proxy $http_proxy
RUN yes '' | pecl install apcu-4.0.10


##########
# Modules
##########
RUN a2enmod rewrite proxy proxy_http

# Configure
COPY php.ini /usr/local/etc/php/php.ini
COPY apache2.conf /etc/apache2/apache2.conf
COPY ext-xdebug.ini /usr/local/etc/php/conf.d/ext-xdebug.ini

########################
# custom configurations
########################
RUN mkdir /home/dockerdev/app

WORKDIR /home/dockerdev/app

VOLUME /home/dockerdev/app

# Make sure the volume mount point is empty
RUN rm -rf /var/www/html \
    && ln -s /home/dockerdev/app /var/www/html

RUN echo '<?php phpinfo(); ?>' > /home/dockerdev/app/index.php

COPY app.conf /etc/apache2/sites-available/app.conf
RUN a2ensite app

RUN apt-get clean && apt-get autoclean && apt-get purge -y --auto-remove

COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod 755 /usr/local/bin/entrypoint.sh \
    && chown -R dockerdev:staff /home/dockerdev

CMD ["/usr/local/bin/entrypoint.sh"]
