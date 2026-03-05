FROM php:8.3-apache

RUN apt-get update \
  && apt-get install -y --no-install-recommends libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
  && docker-php-ext-install mysqli \
  && a2enmod rewrite \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
