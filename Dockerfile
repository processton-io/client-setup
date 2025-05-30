FROM ahmadfaryabkokab/laravel-docker:latest

LABEL maintainer="ahmadkokab@processton.com"

ENV COMPOSER_MEMORY_LIMIT='-1'

#####################################
# Required Variables:
#####################################

RUN export NODE_OPTIONS="--no-deprecation"

#####################################
# Git Safe Directory && Source repos:
#####################################

RUN git config --global --add safe.directory /var/www

RUN npm config set registry https://registry.npmmirror.com/

#####################################
# Files & Directories Permissions:
#####################################

RUN usermod -u 1000 www-data

COPY ./docker/nginx/ /etc/nginx/sites-available/

COPY ./docker/php/fpm.ini /etc/php/8.4/fpm/php.ini
COPY ./docker/php/cli.ini /etc/php/8.4/cli/php.ini

ADD ./docker/supervisor/worker.conf /etc/supervisor/conf.d/worker.conf

COPY ./docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
RUN ln -s /usr/local/bin/docker-entrypoint.sh /
ENTRYPOINT ["docker-entrypoint.sh"]

#####################################
# Make required directories:
#####################################
WORKDIR /var/www

COPY ./bootstrap /var/www/bootstrap
COPY ./config /var/www/config
COPY ./database /var/www/database
COPY ./public /var/www/public
COPY ./resources /var/www/resources
COPY ./routes /var/www/routes
COPY ./storage /var/www/storage
COPY ./tests /var/www/tests
RUN mkdir -p /var/www/vendor
COPY ./composer.json /var/www/composer.json
COPY ./composer.lock /var/www/composer.lock
COPY ./artisan /var/www/artisan
COPY ./phpunit.xml /var/www/phpunit.xml
COPY ./package.json /var/www/package.json
COPY ./package-lock.json /var/www/package-lock.json
COPY ./postcss.config.js /var/www/postcss.config.js
COPY ./vite.config.js /var/www/vite.config.js
copy ./yarn.lock /var/www/yarn.lock
COPY ./tailwind.config.js /var/www/tailwind.config.js

COPY ./app /var/www/app
COPY ./packages/processton /var/packages/processton
COPY ./packages/client /app
COPY .env.example /var/www/.env.example
RUN cp /var/www/.env.example /var/www/.env

RUN composer install --no-dev --optimize-autoloader

USER root



RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /var/packages
RUN chown -R www-data:www-data /var/www/storage
RUN chmod -R 755 /var/www
RUN chmod -R 755 /var/packages
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

RUN chown -R www-data:www-data /var/www/database/database.sqlite

RUN yarn install --frozen-lockfile
RUN yarn build
RUN php artisan optimize:clear
RUN php artisan icons:cache


CMD ["docker-entrypoint.sh"]

EXPOSE 80 443
