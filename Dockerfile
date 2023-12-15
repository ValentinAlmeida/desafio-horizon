FROM php:8.0-fpm

WORKDIR /var/www/html

# Instala as dependências necessárias para o Composer e o driver MySQL
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        unzip \
        libonig-dev \
        libxml2-dev \
        default-mysql-client \
        default-libmysqlclient-dev \
        && docker-php-ext-install pdo_mysql

# Instala o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
