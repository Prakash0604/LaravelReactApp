# Use the specified PHP version as base image
FROM php:8.1-fpm as production

# Set working directory
WORKDIR /var/www

# Install dependencies
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

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd pdo_pgsql mbstring zip exif pcntl opcache \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create and set permissions for the www-api user
RUN groupadd -g 1000 www-api \
    && useradd -u 1000 -ms /bin/bash -g www-api www-api

# Copy application files and set permissions
COPY --chown=www-api:www-api . /var/www
RUN chmod -R 775 /var/www/storage

# Switch to the created user
USER www-api

EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
