#!/bin/bash

# Start MySQL in the background
mysqld_safe --skip-grant-tables &

# Wait for MySQL to start
sleep 5

# Run migrations
mysql < /var/www/app/migrations/init.sql

# Start PHP-FPM and Nginx
php-fpm -F -R &
nginx -g "daemon off;"