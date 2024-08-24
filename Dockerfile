FROM fedora:40 as app

ENV MYSQL_ROOT_PASSWORD=root

# Добавление репозитория Реми
RUN dnf -y install https://rpms.remirepo.net/fedora/remi-release-40.rpm

RUN dnf -y install dnf-plugins-core

RUN dnf config-manager --set-enabled remi

# Устанавливаем MySql Nginx и php-fpm(8.3) и php(8.3)
# RUN dnf -y install nginx php-fpm php php-cli
RUN dnf -y install mariadb-server nginx php-fpm php php-cli

# Устанавливаем расширения необходимые для корректной работы php
RUN dnf -y install php-mysqlnd php-pdo

# Устанавливаем рабочую директорию для образа
WORKDIR /var/www/app

# Копируем файлы приложения
COPY . .

# Запускаем автозагрузчик php классов
RUN php composer.phar dump-autoload

# Перекидываем конфиги nginx а нужную директорию
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Создаем директорию под php-fpm
RUN mkdir /run/php-fpm

CMD ["/var/www/app/run-container.sh"]

EXPOSE 80
