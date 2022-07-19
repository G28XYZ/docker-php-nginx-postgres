FROM php:7.4-fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk add --update --no-cache libgd libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev curl git unzip libxml2-dev libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
        docker-php-ext-install -j$(nproc) opcache pdo_pgsql pgsql && \
        docker-php-ext-enable pdo_pgsql sodium

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD composer i -o ; wait-for-it db:5432 -- bin/console doctrine:migrations:migrate ;  php-fpm

EXPOSE 9000


# FROM php:8.0-fpm

# COPY wait-for-it.sh /usr/bin/wait-for-it

# RUN chmod +x /usr/bin/wait-for-it

# RUN apt-get update && \
#     apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
#     apt-get install -y vim git nodejs && \
#     pecl install apcu && \
#     docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
#     docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
#     docker-php-ext-enable apcu pdo_pgsql sodium
#     # apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# COPY --from=composer /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html

# CMD composer i -o ; wait-for-it db:5432 -- bin/console doctrine:migrations:migrate ;  php-fpm

# EXPOSE 9000