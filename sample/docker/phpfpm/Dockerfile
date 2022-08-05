FROM php:8.1-fpm-alpine

# Update system
RUN apk --update --no-cache add \
    git \
    shadow

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY phpfpm/php.ini /usr/local/etc/php/conf.d/customphp.ini

# User www-data like the user from host machine to avoid file permissions problems
ARG HOST_USER_ID=1000
ARG HOST_GROUP_ID=1000
RUN usermod -u $HOST_USER_ID www-data \
    && groupmod -g $HOST_GROUP_ID www-data

RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
    composer clear-cache

# Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.1.5 \
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
