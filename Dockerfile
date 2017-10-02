FROM phusion/baseimage:0.9.19

ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8
ENV ENVIRONMENT development

CMD ["/sbin/my_init"]

RUN add-apt-repository -y ppa:ondrej/php \
    && add-apt-repository -y ppa:nginx/stable \
    && apt-get update \
    && DEBIAN_FRONTEND="noninteractive" apt-get install -y --force-yes \
        wget \
        curl \
        git \
        php7.0-cli \
        php7.0-curl \
        php7.0-fpm \
        php7.0-xml \
        php7.0-mbstring \
        php7.0-mcrypt \
        php7.0-xdebug \
        php7.0-pgsql \
        unzip \
        nginx \
        npm \
        tor

# misc commands and configs
RUN sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php/7.0/fpm/php.ini \
    && sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php/7.0/cli/php.ini \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf \
    && sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini \
    && sed -i -e "s/#\sserver_names_hash_bucket_size\s64;/server_names_hash_bucket_size 128;/g" /etc/nginx/nginx.conf \
    && mkdir -p /var/www /etc/my_init.d /etc/service/nginx /etc/service/phpfpm /data/config /run/php

# conf files
COPY server/sites-enabled/* /etc/nginx/sites-enabled/

# Adding cronjob files
COPY server/cron/* /etc/cron.d/
RUN chmod -R 600 /etc/cron.d/
RUN chmod +x /etc/cron.d/*

# services
COPY server/runit/nginx.sh  /etc/service/nginx/run
COPY server/runit/phpfpm.sh /etc/service/phpfpm/run

# startup scripts
COPY server/scripts/* /etc/my_init.d/

WORKDIR /var/www
ADD . .

# permissions and owner files changes
RUN chmod +x /etc/service/nginx/run \
    && chmod +x /etc/service/phpfpm/run \
    && chmod +x ./server/scripts/* \
    && chmod 777 server/fix_permissions.sh \
    && chown -R root:root /var/log/nginx \
    && chown -R www-data:www-data .

EXPOSE 80

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /etc/nginx/sites-enabled/default