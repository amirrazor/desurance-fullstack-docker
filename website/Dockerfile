FROM php:7.2-fpm

WORKDIR /var/www/html
COPY . .

RUN docker-php-ext-install pdo 
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install bcmath
RUN ln -snf /usr/share/zoneinfo/Europe/Berlin /etc/localtime && echo Europe/Berlin > /etc/timezone

EXPOSE 8081

CMD ["php", "-S", "0.0.0.0:8081", "-t", "/var/www/html"]