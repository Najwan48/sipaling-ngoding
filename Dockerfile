FROM php:8.3-alpine

WORKDIR /app

# Install dependencies
RUN apk add --no-cache \
    curl \
    composer \
    git

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 755 storage bootstrap/cache
RUN chown -R www-data:www-data /app

# Expose port
EXPOSE 8000

# Start PHP server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
