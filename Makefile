.PHONY: install build start run stop php

all: build start create-cache install start

install-docker-tools:
	docker pull phpqa/php-cs-fixer \
	&& 	docker pull phpunit/phpunit \
	&& docker pull phpstan/phpstan \
	&& docker pull composer

install:
	docker run --rm -v $$(pwd):/app composer install \
	&& docker-compose exec php yarn install \
	&& docker-compose exec php yarn build \
	&& docker-compose exec php make dev

yarn:
	docker-compose exec php yarn install

yarn-build:
	docker-compose exec php yarn build

composer-install:
	docker run --rm -v $$(pwd):/app composer install

composer-update:
	docker run --rm -v $$(pwd):/app composer install

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
	docker run --rm -v $$(pwd)/src:/src phpqa/php-cs-fixer fix /src

cache-clear:
	docker-compose exec php app/console cache:clear

dev:
	php bin/console do:sc:dr --force \
	&& php bin/console do:sc:up --force \
	&& php bin/console do:fi:lo \

create-cache:
	chmod -R 644 var/cache/prod \
	&& chmod -R 644 var/cache/dev
