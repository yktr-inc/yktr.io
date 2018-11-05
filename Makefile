.PHONY: install build start run stop php

all: build install-docker-tools install create-app-dir start

install-docker-tools:
	docker pull phpqa/php-cs-fixer \
	&& 	docker pull phpunit/phpunit \
	&& docker pull phpstan/phpstan \
	&& docker pull composer

install:
	docker run --rm -v $$(pwd):/app composer install \
	&& docker-compose exec php yarn install

yarn:
	docker-compose exec php yarn install

composer-install:
	docker run --rm -v $$(pwd):/app composer install

composer-update:
	docker run --rm -v $$(pwd):/app composer install

create-app-dir:
	mkdir app/cache \
	&& mkdir app/logs \
	&& sudo chmod -R 777 app/logs \
	&& sudo chmod -R 777 app/cache

build:
	docker-compose build

force-build:
	docker-compose build --force-rm --no-cache --pull

start:
	docker-compose up -d

run:
	docker-compose up

stop:
	docker-compose stop

destroy:
	docker-compose down

php:
	docker-compose exec php sh

phpunit:
	docker run --rm -v $$(pwd)/src:/src phpunit/phpunit .

phpstan:
	docker run --rm -v $$(pwd)/src:/src phpstan/phpstan analyse /src

phpcs-dry:
	docker run --rm -v $$(pwd)/src:/src phpqa/php-cs-fixer fix /src --dry-run

phpcs:
<<<<<<< HEAD
	docker run --rm -v $$(pwd)/src:/src phpqa/php-cs-fixer fix /src
=======
	docker run --rm -v $$(pwd)/src:/src phpqa/php-cs-fixer fix /src

cache-clear:
	docker-compose exec php app/console cache:clear
>>>>>>> Adding docker to project (#5)
