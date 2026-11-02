FROM ubuntu:22.04
ENV DEBIAN_FRONTEND=noninteractive
ENV PHP_VERSION=8.1

RUN apt-get update && apt-get install -y \
    nginx php8.1 php8.1-fpm php8.1-cli \
    php8.1-mysql php8.1-mbstring php8.1-xml \
    curl wget git gcc make \
    netcat-traditional iproute2 iputils-ping \
    && apt-get clean

COPY config/php.ini /etc/php/8.1/fpm/conf.d/99-ctf.ini
COPY config/www.conf /etc/php/8.1/fpm/pool.d/www.conf
COPY config/nginx.conf /etc/nginx/sites-available/default
COPY www/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN echo "HTB{php_u4f_1s_n0t_d3ad}" > /var/www/html/user.txt
RUN chmod 444 /var/www/html/user.txt
RUN mkdir -p /run/php && chown www-data:www-data /run/php
RUN mkdir -p /opt/monitor

COPY binaries/php-helper.c /tmp/php-helper.c
RUN apt-get install -y gcc-multilib 2>/dev/null; \
    gcc /tmp/php-helper.c -o /usr/local/bin/php-helper \
    -fno-stack-protector -z execstack -m32 -no-pie || \
    gcc /tmp/php-helper.c -o /usr/local/bin/php-helper \
    -fno-stack-protector -z execstack
RUN chmod 4755 /usr/local/bin/php-helper

COPY startup.sh /startup.sh
RUN chmod +x /startup.sh

EXPOSE 80
CMD ["/startup.sh"]
