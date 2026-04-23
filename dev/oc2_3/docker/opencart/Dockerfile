FROM composer:2 AS composer

FROM php:7.4-apache

ARG OPENCART_VERSION=2.3.0.2
ARG XDEBUG_VERSION=3.1.6

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libcurl4-openssl-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libonig-dev \
    libpng-dev \
    libzip-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
      curl \
      gd \
      intl \
      mbstring \
      mysqli \
      zip \
    && pecl install "xdebug-${XDEBUG_VERSION}" mcrypt \
    && docker-php-ext-enable xdebug mcrypt \
    && a2enmod rewrite \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

COPY apache.conf /etc/apache2/conf-available/opencart.conf
RUN a2enconf opencart

COPY xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN git clone --depth 1 --branch "${OPENCART_VERSION}" https://github.com/opencart/opencart.git /usr/src/opencart \
    && rm -rf /usr/src/opencart/.git \
    # OC 2.3's installer sets sql_mode='MYSQL40', which MySQL 5.7.22+ removed. Clear it.
    && sed -i "s/SET @@session.sql_mode = 'MYSQL40'/SET @@session.sql_mode = ''/g" \
       /usr/src/opencart/upload/install/cli_install.php \
       /usr/src/opencart/upload/install/model/install/install.php

WORKDIR /usr/src/opencart

# OC 2.3's composer.json references Klarna/Cardinity SDKs that pull in Guzzle versions flagged
# by security advisories, which modern Composer refuses to install. The IBAN extension and OC
# core run fine without system/storage/vendor, so composer install is skipped here.
# (If you need those bundled payment SDKs, pin Composer to 2.6 or set audit.block-insecure=false.)

WORKDIR /

COPY entrypoint.sh /usr/local/bin/docker-opencart-entrypoint
RUN chmod +x /usr/local/bin/docker-opencart-entrypoint

ENTRYPOINT ["docker-opencart-entrypoint"]
CMD ["apache2-foreground"]
