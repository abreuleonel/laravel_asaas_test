FROM wyveo/nginx-php-fpm:latest

COPY . /usr/share/nginx/html 
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /usr/share/nginx/html

RUN apt-get update && apt-get install vim -y

CMD php artisan serve --host=0.0.0.0

EXPOSE 8000