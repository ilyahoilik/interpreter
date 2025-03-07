FROM php:8.4-cli-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY . /app

WORKDIR /app

RUN composer install && \
    chown www-data:www-data -R /app && \
    chmod 0755 -R /app

ENTRYPOINT ["/app/docker/entrypoint.sh"]