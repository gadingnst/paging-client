FROM php:7.2-apache

WORKDIR /var/www/html/Paging

COPY . .
RUN chmod ugo+x wait-for-it.sh
RUN docker-php-ext-install mysqli


EXPOSE 80

CMD ["apache2-foreground"]


