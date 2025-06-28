FROM php:8.2-fpm

# Install Node.js dan npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update && apt-get install -y nodejs

# Install library untuk ext-zip dan ekstensi lain
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
