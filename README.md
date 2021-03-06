# Damián Marcote
## LANACION PHP TEST

## Requirements

* [Docker](https://www.docker.com/products/docker-desktop)

This is a custom LAMP stack environment built using Docker Compose. It consists following:

* PHP 7.1
* Apache 2.4
* MySQL 5.7
* phpMyAdmin

## Installation

This process will take several minutes.

```shell
./setup
```

Your LAMP stack is now ready!! You can access it via [http://localhost:8089/](http://localhost:8089/).

## phpMyAdmin

phpMyAdmin is configured to run on port 8088. Use following default credentials.

[http://localhost:8088/](http://localhost:8088/) <br />
U: root <br />
P: root <br />

## Authentication

This instalation comes with USER Migrations and Seeder. Use following default credentials to login into the App.

U: admin@admin.com <br />
P: adminadmin <br />

## Postman

Import `./config/postman/LA NACION.postman_collection.json` and run the API endpoints.

## RUN commands

To execute commands into container, prefix "./run" + command

```shell
./run php artisan migrate
```

## Test

```shell
./run ./vendor/bin/phpunit --filter ApiTokenTest
```

## The APP

The application contains a CRM to create, modify and delete points. In addition, it has an API to:
- List all the points.
- Show a point.
- Add a point.
- Modify a point.
- Delete a point.
- List nearest points.

And uses LeafletJs and OpenStreetMap to show points on a map.

Api Endpoints are protected with JWT. Remember to login to the API to capture TOKEN and paste in the authorization headers.

Please import `./config/postman/LA NACION.postman_collection.json`

```shell
Authorization: Bearer eyJhbGciOiJIUzI1NiI...
```

<br />
<br />
<br />
<br />

#

<br />


## Configuration

This package comes with default configuration options. You can modify them by creating `.env` file in your root directory.

To make it easy, just copy the content from `sample.env` file and update the environment variable values as per your need.

### Configuration Variables

There are following configuration variables available and you can customize them by overwritting in your own `.env` file.

_**DOCUMENT_ROOT**_

It is a document root for Apache server. The default value for this is `./www`. All your sites will go here and will be synced automatically.

_**MYSQL_DATA_DIR**_

This is MySQL data directory. The default value for this is `./data/mysql`. All your MySQL data files will be stored here.

_**VHOSTS_DIR**_

This is for virtual hosts. The default value for this is `./config/vhosts`. You can place your virtual hosts conf files here.

> Make sure you add an entry to your system's `hosts` file for each virtual host.

_**APACHE_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/apache2`.

_**MYSQL_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/mysql`.

## Web Server

Apache is configured to run on port 80. So, you can access it via `http://localhost`.

#### Apache Modules

By default following modules are enabled.

* rewrite
* headers

> If you want to enable more modules, just update `./bin/webserver/Dockerfile`. You can also generate a PR and we will merge if seems good for general purpose.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

#### Connect via SSH

You can connect to web server using `docker exec` command to perform various operation on it. Use below command to login to container via ssh.

```shell
docker exec -it ${container} /bin/bash
```

## PHP

The installed version of PHP is 7.1.

#### Extensions

By default following extensions are installed.

* mysqli
* mbstring
* zip
* intl
* mcrypt
* curl
* json
* iconv
* xml
* xmlrpc
* gd

> If you want to install more extension, just update `./bin/webserver/Dockerfile`. You can also generate a PR and we will merge if seems good for general purpose.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

## Redis

It comes with Redis. It runs on default port `6379`.
