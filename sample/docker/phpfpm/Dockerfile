FROM php:7.3-fpm-stretch

WORKDIR /var/www/html

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Update debian and install php extensions
RUN \
    apt-get update \
    && apt-get -y upgrade \
    && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        gnupg \
        libmcrypt-dev \
        libxml2-dev \
        wget \
        curl \
        locales \
        openssl \
        zip \
        unzip \
        libzip-dev \
        git \
        iproute2 \
        dnsutils \
        iputils-ping \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    # Configure docker
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install -j$(nproc) \
        gettext \
        pdo \
        mysqli \
        pdo_mysql \
        mbstring \
        iconv \
        opcache \
        zip \
        bcmath \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Xdebug
RUN pecl install xdebug-2.8.0 \
    && rm -rf /tmp/pear

# User www-data like a user from host machine
ARG HOST_USER_ID=1000
ARG HOST_GROUP_ID=1000
RUN usermod -u $HOST_USER_ID www-data \
    && groupmod -g $HOST_GROUP_ID www-data \
    && chown -R www-data:www-data /var/www

VOLUME '/var/www/html'
EXPOSE 80 443

COPY ./phpfpm/docker-entrypoint.sh /usr/local/bin/
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
