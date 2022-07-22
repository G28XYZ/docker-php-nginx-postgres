FROM php:8.0-fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk add --update --no-cache libgd libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev curl git unzip libxml2-dev libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
        docker-php-ext-install -j$(nproc) opcache pdo_pgsql pgsql && \
        docker-php-ext-enable pdo_pgsql sodium

RUN apk add nodejs neovim ripgrep alpine-sdk --update && \
    git clone https://github.com/NvChad/NvChad ~/.config/nvim

# copy config php to path in machine
COPY ./php.ini-production /usr/local/etc/php/php.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD composer i -o ; wait-for-it db:5432 -- bin/console doctrine:migrations:migrate ;  php-fpm

EXPOSE 9000