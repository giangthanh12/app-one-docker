# Set master image
FROM php:7.4-fpm-alpine

LABEL maintainer="Nguyen Thanh Giang (giangthanh187126@gmail.com)"

# Set working directory
WORKDIR /var/www/html

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Additional dependencies
RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      # --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*

RUN apk add libzip-dev
# Add and Enable PHP-PDO Extenstions for PHP connect Mysql
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# This extension required for Laravel Horizon
# RUN docker-php-ext-install pcntl

# Remove Cache
RUN rm -rf /var/cache/apk/*

# COPY .docker/supervisord.conf /etc/supervisord.conf
# COPY .docker/supervisor.d /etc/supervisor.d

# Use the default production configuration for PHP-FPM ($PHP_INI_DIR variable already set by the default image)
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Add UID '1000' to www-data
# RUN usermod -u 1000 www-data

# Copy existing application directory
COPY . .

# Chang app directory permission
# RUN chown -R www-data:www-data .

# ENV ENABLE_CRONTAB 1
# ENV ENABLE_HORIZON 1

# ENTRYPOINT ["sh", "/var/www/html/.docker/docker-entrypoint.sh"]

# CMD supervisord -n -c /etc/supervisord.conf
