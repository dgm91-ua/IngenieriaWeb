FROM php:8.2-apache

# Habilitamos mod_rewrite
RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    libzip-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-install gettext intl pdo_mysql gd zip

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Copiamos todo el proyecto (incluyendo /public) a la carpeta html
COPY . /var/www/html
WORKDIR /var/www/html

# Ajustamos DocumentRoot para que apunte a /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Configuramos permisos y directivas para que Apache pueda servir el contenido
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf

RUN a2enconf laravel

# Ajustamos permisos para que www-data sea el dueño (importante para cache y logs)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
