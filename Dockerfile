FROM php:8.4-cli

# Install ekstensi PHP wajib untuk Laravel, MySQL, dan gambar
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Pastikan folder uploads & cache bisa ditulis
RUN mkdir -p public/uploads storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache public/uploads

# Install dependensi PHP 8.4 (tanpa dev packages agar ringan)
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --class=UserSeeder --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
