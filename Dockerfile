FROM php:7.4-fpm-alpine

RUN apk update && apk upgrade \
  && apk add build-base php7-pear php7-dev openssl-dev composer

RUN pecl install mongodb && echo 'extension=mongodb.so' > /usr/local/etc/php/conf.d/mongo.ini \
  && composer require mongodb/mongodb firebase/php-jwt
