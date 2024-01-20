.PHONY: help

SAIL := ./vendor/bin/sail

help: ## Display all available commands.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

install: ## Setup project and install dependencies.
	@cp .env.example .env
	@composer install
	@php artisan key:generate
	@npm install
	@npm run build

start: ## Start containers.
	$(SAIL) up -d

stop: ## Stop containers.
	$(SAIL) stop

migrate: ## Migrate database migrations.
	$(SAIL) artisan migrate

migrate-seed: ## Migrate database migrations and seed dummy data.
	$(SAIL) artisan migrate --seed

migrate-fresh-seed: ## Refresh database, migrate database migrations and seed dummy data.
	$(SAIL) artisan migrate:fresh --seed

clear: ## Clear application and configuration cache.
	$(SAIL) artisan optimize:clear

optimize: ## Cache config and routes.
	$(SAIL) artisan optimize

