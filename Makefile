.PHONY: install build start run stop php

all: build start install yarn-build yarn cache-clear

install-docker-tools:
	docker pull phpqa/php-cs-fixer \
	&& 	docker pull phpunit/phpunit \
	&& docker pull phpstan/phpstan

install-dev:
	make build \
	&& make start \
	&& docker-compose exec php-yktr-dev make composer-install \
	&& docker-compose exec php-yktr-dev make yarn \
	&& docker-compose exec php-yktr-dev make yarn-build \
	&& docker-compose exec php-yktr-dev make create-db \
	&& docker-compose exec php-yktr-dev make cache-clear

install-prod:
	make build \
	&& make start \
	&& docker-compose exec php-yktr-prod make composer-install-prod \
	&& docker-compose exec php-yktr-prod make yarn \
	&& docker-compose exec php-yktr-prod make yarn-build \
	&& docker-compose exec php-yktr-prod make create-db-prod \
	&& docker-compose exec php-yktr-prod make cache-clear

yarn:
	yarn install

yarn-build:
	yarn build

composer-install:
	composer install

composer-install-prod:
	composer install --no-dev

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
	php bin/console cache:clear

dev:
	php bin/console doctrine:database:drop --if-exists --force \
	&& php bin/console doctrine:database:create \
	&& php bin/console do:sc:up --force \
	&& php bin/console do:fi:lo --append \

create-db:
	php bin/console doctrine:database:drop --if-exists --force \
	&& php bin/console doctrine:database:create \
	&& php bin/console do:sc:up --force \
	&& php bin/console do:fi:lo --append \

create-db-prod:
	php bin/console doctrine:database:drop --if-exists --force \
	&& php bin/console doctrine:database:create \
	&& php bin/console doctrine:migrations:diff \
	&& php bin/console doctrine:migrations:migrate \
	&& php bin/console do:fi:lo --append \



