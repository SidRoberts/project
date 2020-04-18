FROM php:7.4-fpm-alpine

# Install Postgres PHP extension
RUN apk add postgresql-dev \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql \
    && apk del \
        postgresql-libs \
        libsasl \
        db \
    && rm -rf /tmp/* /var/cache/apk/*
