FROM php:8.2-apache

# Instalar extensiones necesarias para conectar a PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copiar el código de tu API al directorio del servidor web
COPY . /var/www/html/

# Habilitar el módulo rewrite de Apache (útil para rutas amigables/APIs)
RUN a2enmod rewrite

# Exponer el puerto por defecto de Apache
EXPOSE 80