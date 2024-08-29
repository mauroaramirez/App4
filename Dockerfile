FROM php:8.2-apache

WORKDIR /etc/apache2

RUN \
    a2enmod rewrite \
    && cat apache2.conf | sed -e '172c\\tAllowOverride All' apache2.conf > apache2.conf.bk \
    && rm apache2.conf \
    && mv apache2.conf.bk apache2.conf

WORKDIR /var/www/html

RUN apt-get update && apt-get install --yes --no-install-recommends \
    zlib1g-dev \
    libzip-dev \
    unzip \    
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libssl-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 
    
LABEL description="PHP + GD + Apache + PDO + DriverMongo + Composer"

#EXPOSE 4060