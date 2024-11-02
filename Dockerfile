# Usa la imagen oficial de PHP con Apache como base
FROM php:8.1-apache

# Habilita los módulos necesarios de Apache y PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo pdo_mysql && \
    a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el contenido de tu aplicación al contenedor
COPY . /var/www/html/

# Ajusta permisos para el directorio de la aplicación
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Instala PHPUnit usando Composer
WORKDIR /var/www/html
RUN composer require --dev phpunit/phpunit ^10

# Expone el puerto 80
EXPOSE 80

# Establece el comando por defecto
CMD ["apache2-foreground"]
