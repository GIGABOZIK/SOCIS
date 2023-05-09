# FROM php:fpm
FROM php:fpm-alpine

#` Открытие порта
# EXPOSE 9000

RUN \
    #` Установка необходимых зависимостей
    docker-php-ext-install \
        pdo_mysql \
        # mysqli \
        # pdo_pgsql \
        # redis \
        # zip \
        # opcache \
        # memcached \
        # gd \
        # imagick \
        # exif \
        # bcmath \
        # soap \
        # intl \
        # xdebug \
        #
    #` Установленные по умолчанию [PHP Modules] - `docker exec cgi-php-fpm php -m`
        # Core ctype curl date dom fileinfo filter ftp hash iconv json
        # libxml mbstring mysqlnd openssl pcre PDO pdo_sqlite Phar posix
        # random readline Reflection session SimpleXML sodium SPL sqlite3
        # standard tokenizer xml xmlreader xmlwriter zlib
    #` Установка правильных разрешений на файлы
    # chown -R www-data:www-data /var/www
    #
    && echo 'php.Dockerfile compiled'
#