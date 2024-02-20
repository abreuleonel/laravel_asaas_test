FROM wyveo/nginx-php-fpm:latest

COPY . /usr/share/nginx/html 
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN apt-get update && apt-get install vim -y

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN composer install

RUN php artisan migrate

CMD php artisan serve --host=0.0.0.0

EXPOSE 8000