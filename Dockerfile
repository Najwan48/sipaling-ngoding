FROM php:8.3-alpine

WORKDIR /app

# Install dependencies and PHP extensions
RUN apk add --no-cache \
    curl \
    composer \
    git \
    libzip-dev \
    oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install \
    session \
    fileinfo \
    tokenizer \
    dom \
    zip \
    mbstring \
    pdo \
    pdo_sqlite

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate APP_KEY if missing
RUN php artisan key:generate --force || true

# Set permissions
RUN chmod -R 755 storage bootstrap/cache
RUN mkdir -p storage/logs && chmod -R 777 storage

# Expose port
EXPOSE 8000

# Start PHP server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
