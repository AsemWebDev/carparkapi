SHELL=/bin/bash

up: ## Build the Docker containers
	docker compose up --build -d --force-recreate

down: ## Stop the Docker containers
	docker compose down

migrate:
	php bin/console doctrine:migrations:migrate

ss:
	symfony server:start
