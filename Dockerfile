# Usa la imagen de PHP con Apache
FROM php:7.4-apache

# Copia los archivos de tu proyecto al directorio de Apache
COPY . /var/www/html

# Establece los permisos necesarios para el directorio de trabajo
RUN chown -R www-data:www-data /var/www/html

# Habilita el módulo de reescritura de URL (útil si usas archivos .htaccess)
RUN a2enmod rewrite

# Expone el puerto 80 (puerto predeterminado de Apache)
EXPOSE 80

# Comando para iniciar Apache en modo foreground
CMD ["apache2-foreground"]
