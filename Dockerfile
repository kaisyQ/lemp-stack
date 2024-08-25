FROM fedora:40 as app

ENV MYSQL_ROOT_PASSWORD=root

# Добавление репозитория Реми
RUN dnf -y install https://rpms.remirepo.net/fedora/remi-release-40.rpm

RUN dnf -y install dnf-plugins-core

RUN dnf config-manager --set-enabled remi

# Устанавливаем MySql Nginx и php-fpm(8.3) и php(8.3) и prometeus
RUN dnf -y install mariadb-server nginx php-fpm php php-cli 

# Устанавливаем расширения необходимые для корректной работы php
RUN dnf -y install php-mysqlnd php-pdo unzip zip 

# Устанавливаем рабочую директорию для образа
WORKDIR /var/www/app

# Копируем файлы приложения
COPY . .

# Создаем .env файл на основе .env.example
RUN cp .env.example .env

# Запускаем автозагрузчик php классов
RUN php composer.phar dump-autoload


# Устаналивем зависимости composer
RUN php composer.phar install --no-scripts --no-dev

# Перекидываем конфиги nginx а нужную директорию
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Создаем директорию под php-fpm
RUN mkdir /run/php-fpm

CMD ["/var/www/app/run-container.sh"]

EXPOSE 80 3306
