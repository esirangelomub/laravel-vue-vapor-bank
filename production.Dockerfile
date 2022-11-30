FROM laravelphp/vapor:php81

RUN apk add --update --no-cache gmp gmp-dev \
    && docker-php-ext-install gmp

COPY . /var/task
