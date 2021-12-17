PROJECT_NAME = quizapp

.PHONY : help bootstrap run env build up down rm composer-install composer-update seed composer-dump-autoload \
		 migrate migrate-down migrate-refresh migrate-fresh migrate-reset tests exec dump

.DEFAULT_GOAL := help

help: ## show this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

bootstrap: ## full start application
	make env
	make build
	make up
	sleep 5
	make composer-install
	make key
	make migrate-refresh
#	make seed

run: ## bootstrap without build containers
	make env
	make up
	sleep 5
	make composer-install
	make key
	make migrate-refresh


env: ## cp env file
	cp .env.docker .env

up: ## up all containers
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml up -d

build: ## build all containers
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml build

down: ## down all containers
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml down

rm: ## force stop and remove all containers
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml rm -fsv

composer-install: ## composer install in app container
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app composer install

composer-update: ## composer update in app container
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app composer update

composer-dump-autoload: ## composer dump-autoload in app container
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app composer dump-autoload

tests: ## run php unit tests
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app /app/vendor/bin/phpunit

key: ## generate application key
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan key:generate

migrate: ## up all migrations
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan migrate

migrate-fresh: ## up all migrations
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan migrate:fresh

migrate-reset: ## rollback all migrations
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan migrate:reset

migrate-refresh: ## refresh db
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan migrate:refresh

seed: ## run all seeds
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app php artisan db:seed

exec: ## docker exec
	docker-compose -p ${PROJECT_NAME} -f docker-compose.yaml exec app bash
