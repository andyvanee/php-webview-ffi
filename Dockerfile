FROM ubuntu:bionic

RUN apt update && apt install -y \
    build-essential git curl autoconf bison libtool libssl-dev \
    libcurl4-openssl-dev libxml2-dev libreadline7 libreadline-dev \
    libzip-dev libzip4 openssl pkg-config zlib1g-dev re2c sqlite3 \
    libsqlite3-dev libffi-dev libonig-dev libsodium-dev cmake \
    libgtk-3-dev libwebkit2gtk-4.0-dev

WORKDIR /tmp

RUN curl https://codeload.github.com/php/php-src/tar.gz/php-7.4.0beta4 | tar xvz \
    && cd php-src-php-7.4.0beta4  \
    && autoconf && ./buildconf --force \
    && ./configure --with-readline --with-openssl --with-curl --with-ffi --enable-mbstring --enable-pcntl --enable-sockets --with-sodium --with-zlib --enable-opcache \
    && make && make install \
    && cd .. \
    && rm -rf php-src-php-7.4.0beta4 \
    && curl https://getcomposer.org/installer > /composer-setup.php \
    && php /composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm /composer-setup.php

ADD config/php.ini /usr/local/lib/php.ini

ADD . /app

WORKDIR /app

RUN make
