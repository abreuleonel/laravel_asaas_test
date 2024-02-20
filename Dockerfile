FROM wyveo/nginx-php-fpm:latest

COPY . /usr/share/nginx/html 

WORKDIR /usr/share/nginx/html

RUN apt-key adv --fetch-keys 'https://packages.sury.org/php/apt.gpg' > /dev/null 2>&1
RUN apt update && apt install vim -y && apt install php-mysql -y &&  apt install php-mbstring -y

CMD php artisan serve --host=0.0.0.0

EXPOSE 8000
