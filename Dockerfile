FROM phusion/baseimage:0.10.1

ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8

CMD ["/sbin/my_init"]

ARG DEBIAN_FRONTEND=noninteractive


RUN apt-get update -y && apt-get install -y wget .build-essential python-software-properties git-core vim nano
RUN add-apt-repository -y ppa:ondrej/php && add-apt-repository -y ppa:nginx/stable

# installing packages
RUN apt-get update && apt-get install -y --no-install-recommends \
        wget \
        curl \
        git \
        php-pear \
        php7.2 \
        php7.2-cli \
        php7.2-soap \
        php7.2-curl \
        php7.2-fpm \
        php7.2-pgsql \
        php7.2-xml \
        php7.2-bcmath \
        php7.2-mbstring \
        php7.2-yaml \
        php-xdebug \
        unzip \
        nginx

# Allow running commands from www-data user
RUN chsh -s /bin/bash www-data

WORKDIR /var/www/drawing-package/current

