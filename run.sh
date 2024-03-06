#!/bin/bash

# Ожидание доступности базы данных
# shellcheck disable=SC2164
cd /var/www/html
/var/www/html/wait-for-it.sh db:5432 --timeout=30s

# Выполнение миграции базы данных
php artisan migrate
php artisan db:seed
npm install
php artisan key:generate
# Бесконечный цикл для удержания контейнера активным
apache2-foreground

