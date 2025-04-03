FROM php:8.1-fpm as production

# Set working directory
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    libwebp-dev \
    librdkafka-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd pdo_pgsql mbstring zip exif pcntl opcache \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www-api \
    && useradd -u 1000 -ms /bin/bash -g www-api www-api

COPY --chown=www-api:www-api . /var/www
RUN chmod -R 775 /var/www/storage

USER www-api

EXPOSE 9000

CMD ["php-fpm"]
