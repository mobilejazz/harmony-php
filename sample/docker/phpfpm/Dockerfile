FROM php:8.0.0-fpm-alpine

# Update system
RUN apk --update --no-cache add \
    git \
    shadow

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# User www-data like the user from host machine to avoid file permissions problems
ARG HOST_USER_ID=1000
ARG HOST_GROUP_ID=1000
RUN usermod -u $HOST_USER_ID www-data \
    && groupmod -g $HOST_GROUP_ID www-data

# Composer 2.0.8
RUN curl -sS \
    https://raw.githubusercontent.com/composer/getcomposer.org/bfd95e2a4383ee9cf7c058c2df29d7acb5f86d77/web/installer \
    | php -- --quiet --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.0.1 \
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

COPY ./phpfpm/docker-set-host-internal.sh /usr/local/bin/
