# Gunakan PHP dari gambar resmi PHP
FROM php:8.2-fpm

# Set direktori kerja ke direktori proyek Laravel
WORKDIR /var/www/html

# Instal dependensi
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        curl \
        && docker-php-ext-install zip pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Salin file composer.json dan composer.lock ke dalam kontainer
COPY composer.json composer.lock ./

# Instal dependensi PHP
RUN composer install --no-scripts --no-autoloader

# Salin sisa kode sumber proyek ke dalam kontainer
COPY . .

# Generate autoload dan cache
RUN composer dump-autoload
RUN php artisan key:generate

# Izinkan PHP-FPM untuk mengakses file di direktori storage dan bootstrap
RUN chown -R www-data:www-data storage bootstrap

# Port yang akan digunakan oleh server web di dalam kontainer
EXPOSE 8000

# Perintah yang akan dijalankan ketika kontainer dimulai
CMD php artisan serve --host=0.0.0.0 --port=8000
