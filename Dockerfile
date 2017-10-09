FROM wordpress:latest

RUN apt-get update
RUN apt-get -y install wget unzip

RUN apt-get clean
RUN rm -rf /tmp/*

RUN chown -R www-data:www-data /usr/src/wordpress/wp-content

WORKDIR /var/www/html