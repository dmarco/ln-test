FROM php:7.3-apache

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      procps \
      vim \
			curl \
      git \
      unzip \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      supervisor \
      cron \
      libzip-dev \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install \
			mysqli \
      pdo_mysql \
      intl \
      zip && \
      rm -fr /tmp/* && \
      rm -rf /var/list/apt/* && \
      rm -r /var/lib/apt/lists/* && \
      apt-get clean

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash
RUN apt-get install -y nodejs

# Enable apache modules
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=example.com"
RUN a2enmod rewrite
RUN a2enmod ssl