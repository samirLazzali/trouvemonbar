FROM php:7.1-fpm

ARG DOCKER_USER
ARG DOCKER_USER_ID

RUN apt-get update -qq \
    && apt-get install -y --no-install-recommends \
        gettext-base openssh-client wget git make cmake libssl-dev libssl-doc libxml2-dev libcurl3-dev sudo libpq-dev \
    && pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql zip bcmath mbstring xml curl \
    && curl -sS http://getcomposer.org/installer | php -- --filename=composer \
    && chmod a+x composer \
    && mv composer /usr/local/bin/composer \
    && composer -q global require "hirak/prestissimo:^0.3" \
    && composer -q global require "phing/phing:^2.16" \
    && ln -s /root/.composer/vendor/phing/phing/bin/phing /usr/bin/phing \
    && apt-get clean \
    && mkdir /nginx \
    && rm -rf /var/lib/apt/lists/* \
    && cd -

# Copy config
COPY ./config/ /docker/
ADD config/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini


# Add local user
RUN useradd --shell /bin/bash -u ${DOCKER_USER_ID} -o -c "" -m ${DOCKER_USER} \
    && adduser ${DOCKER_USER} sudo \
    && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers \
    && export HOME=/home/${DOCKER_USER}

# add sendmail

RUN apt-get update && apt-get install -q -y ssmtp mailutils && rm -rf /var/lib/apt/lists/*

RUN echo "hostname=localhost.localdomain" > /etc/ssmtp/ssmtp.conf
RUN echo "root=root@example.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "mailhub=maildev" >> /etc/ssmtp/ssmtp.conf

RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
ENTRYPOINT ["/bin/bash", "/docker/entrypoint.sh"]
CMD ["php-fpm"]
