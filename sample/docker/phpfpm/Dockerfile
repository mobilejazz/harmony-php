FROM php:8.0-fpm-alpine

ENV TZ Europe/Paris

# Update system
RUN apk --update --no-cache add \
    $PHPIZE_DEPS \
    bash \
    git \
    shadow \
    zlib-dev \
    libzip-dev \
    make \
    && update-ca-certificates

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY phpfpm/php.ini /usr/local/etc/php/conf.d/customphp.ini

# User www-data like the user from host machine to avoid file permissions problems
ARG HOST_USER_ID=1000
ARG HOST_GROUP_ID=1000
RUN usermod -u $HOST_USER_ID www-data \
    && groupmod -g $HOST_GROUP_ID www-data

# Composer 2.1.8
RUN curl -sS \
    https://raw.githubusercontent.com/composer/getcomposer.org/b2ffe854401d063de8a3bf6b0811884243a381ba/web/installer \
    | php -- --quiet --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# PCOV and Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install \
        pcov \
        xdebug-3.1.0beta2 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.log_level = 0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/var/log/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && mkdir -p /var/log/xdebug \
    && touch /var/log/xdebug/xdebug.log \
    && chmod 664 /var/log/xdebug/xdebug.log \
    && chown www-data:www-data /var/log/xdebug/xdebug.log \
    && rm -rf /tmp/pear

USER www-data
