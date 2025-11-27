DC = docker compose

.PHONY: up down build logs exec-back migrate seed route-list

up:
	$(DC) up -d

down:
	$(DC) down

build:
	$(DC) build

logs:
	$(DC) logs -f

exec-back:
	$(DC) exec backend bash

migrate:
	$(DC) exec backend php artisan migrate

seed:
	$(DC) exec backend php artisan db:seed

route-list:
	$(DC) exec backend php artisan route:list

