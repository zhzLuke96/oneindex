FROM php:fpm-alpine

COPY docker-entrypoint.sh php.ini default.conf /
RUN apk add --no-cache \
        git \
        bash \
        nginx \
        tzdata \
        openssh && \
    mkdir -p /run/nginx && \
    mv /default.conf /etc/nginx/conf.d && \
    mv /php.ini /usr/local/etc/php && \
    chmod +x /docker-entrypoint.sh && \
    git clone https://github.com/david7207/oneindexMod.git --depth=1 /var/www/html && \
    ssh-keygen -A

COPY ImagesController.php /var/www/html/controller/

# Persistent config file and cache
VOLUME [ "/var/www/html/config", "/var/www/html/cache" ]
ENTRYPOINT [ "/docker-entrypoint.sh" ]