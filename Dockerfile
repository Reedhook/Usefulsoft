FROM php:8.2-apache

# Установка зависимостей
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    libpq-dev

RUN docker-php-ext-install pdo_pgsql zip
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html! ${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/! ${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# Установка nvm (Node Version Manager)



# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY . .
RUN mv .env.example .env
# Устанавливаем зависимости проекта
RUN composer install
# Установка прав на исполнение для run.sh
RUN chmod +x /var/www/html/run.sh
RUN chmod +x /var/www/html/wait-for-it.sh
ENTRYPOINT ["/var/www/html/run.sh"]
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
# Активация nvm в текущей сессии
# Установка Node.js и npm
RUN apt-get install -y nodejs npm
RUN chmod -R 777 /var/www/html/
# Запуск npm run dev
