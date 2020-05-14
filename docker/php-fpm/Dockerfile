FROM php:7.3-fpm-alpine

# Install PHP extensions
RUN apk update && apk upgrade --update && apk --no-cache add \
    git \
    vim less \
    icu-dev \
    autoconf \
    make \
    g++ \
    gcc \
    mysql-client \
    && rm -r /var/cache/apk/*

RUN docker-php-ext-install -j$(nproc) \
    iconv \
    intl \
    mbstring \
    pdo_mysql

#ここです
RUN curl -sL https://deb.nodesource.com/setup_13.x | bash - && \
apt-get install -y nodejs

COPY  ./php.ini /usr/local/etc/php/conf.d/my-php.ini
COPY  ./php-fpm.conf /usr/local/etc/php-fpm.d/my-php-fpm.conf
