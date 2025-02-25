# Build Stage
FROM php:8.3.17-fpm-alpine3.21 AS build

WORKDIR /var/www

# Install dependencies needed for compilation
RUN apk add --no-cache \
    freetype-dev \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    icu-dev \
    oniguruma-dev \
    libpq-dev \
    unzip

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl bcmath intl gd xml fileinfo

# Production Image
FROM php:8.3.17-fpm-alpine3.21 AS runtime

WORKDIR /var/www

# Install only runtime dependencies
RUN apk add --no-cache \
    mysql-client \
    postgresql-client \
    libpng \
    freetype \
    libzip \
    icu

# Copy necessary files from build stage
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions

# Set permissions
RUN chown -R www-data:www-data /var/www