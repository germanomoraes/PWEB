# Usa a imagem oficial do PHP 8.2 com o servidor Apache
FROM php:8.2-apache

# Instala extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Habilita módulos Apache
RUN a2enmod rewrite
RUN a2enmod headers

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia todos os arquivos para o container
COPY . /var/www/html/

# Define permissões
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Criar diretório para dados
RUN mkdir -p /var/www/html/backend/data
RUN chmod -R 777 /var/www/html/backend/data
RUN chown -R www-data:www-data /var/www/html/backend/data

# Configurar Apache para servir frontend como raiz
RUN echo '<VirtualHost *:80>\n\
    ServerName localhost\n\
    DocumentRoot /var/www/html\n\
    \n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Ativar site padrão
RUN a2ensite 000-default

# Aumentar limite de upload
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/api/health || exit 1

# Libera a porta 80 do container
EXPOSE 80

# Inicia o Apache
CMD ["apache2-foreground"]

