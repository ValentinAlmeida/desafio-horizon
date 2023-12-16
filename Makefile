.PHONY: help setup up down migrate seed test

help:
	@echo "Available targets:"
	@echo "  make setup     - Install dependencies and set up the environment"
	@echo "  make up        - Start Docker containers"
	@echo "  make down      - Stop and remove Docker containers"
	@echo "  make migrate   - Run database migrations"
	@echo "  make seed      - Seed the database with sample data"
	@echo "  make test      - Run tests"

setup:
	composer install
	$(if $(filter Windows%,$(OS)),copy .env.example .env, cp .env.example .env)
	php artisan key:generate

up:
	docker-compose up --build

down:
	docker-compose down -v

migrate:
	docker-compose exec app php artisan migrate

seed:
	docker-compose exec app php artisan db:seed

test:
	docker-compose exec app php artisan test

install: setup up migrate seed
	@echo "Project installed and ready to use."

.DEFAULT_GOAL := help
