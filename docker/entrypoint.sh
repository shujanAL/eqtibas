#!/bin/sh
set -eu

PORT="${PORT:-10000}"

sed -i "s/Listen 80/Listen ${PORT}/g; s/Listen 10000/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:10000>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache

php artisan package:discover --ansi
php artisan config:clear
php artisan route:clear
php artisan view:clear

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

php artisan config:cache
php artisan view:cache

exec "$@"
