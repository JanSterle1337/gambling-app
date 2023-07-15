include .env

.PHONY: up down stop restart prune ps logs logs-now shell install update

default: up

## help			Print commands help.
help : Makefile
	@sed -n 's/^##//p' $<

## up			Start up containers.
up:
	@echo "Starting up containers for $(PROJECT_NAME)..."
	docker compose pull
	@docker compose up -d --remove-orphans

down: stop

## stop			Stop containers.
stop:
	@echo "Stopping containers for $(PROJECT_NAME)..."
	@docker compose stop

## start			Start containers without updating.
start:
	@echo "Starting containers for $(PROJECT_NAME) from where you left off..."
	@docker compose start

restart:
	@echo "Restarting containers for $(PROJECT_NAME)..."
	@docker compose up -d --remove-orphans --build $(filter-out $@,$(MAKECMDGOALS))

## prune			Remove containers and their volumes.
##			You can optionally pass an argument with the service name to prune single container
##			prune php	: Prune `php` container and remove its volumes.
##			prune nginx php	: Prune `nginx` and `php` containers and remove their volumes.
prune:
	@echo "Removing containers for $(PROJECT_NAME)..."
	@docker compose rm -s -v -f $(filter-out $@,$(MAKECMDGOALS))

## ps			List running containers in docker ps format.
ps:
	@docker ps --filter name='$(PROJECT_NAME)*'

## psc			List running containers in docker compose ps format.
psc:
	@docker compose ps --filter name='$(PROJECT_NAME)*'

## logs			View containers logs.
##			You can optinally pass an argument with the service name to limit logs
##			logs php	: View `php` container logs.
##			logs nginx php	: View `nginx` and `php` containers logs.
logs:
	@docker compose logs -f $(filter-out $@,$(MAKECMDGOALS))

## logs			View containers logs from this moment on.
##			You can optinally pass an argument with the service name to limit logs
##			logs php	: View `php` container logs.
##			logs nginx php	: View `nginx` and `php` containers logs.
logs-now:
	@docker compose logs -f --tail=0 $(filter-out $@,$(MAKECMDGOALS))

## sh			Access a container via shell.
sh:
	@echo "SSH into the $(filter-out $@,$(MAKECMDGOALS)) container..."
	@docker exec -ti -e COLUMNS=$(shell tput cols) -e LINES=$(shell tput lines) $(shell docker ps --filter name='$(PROJECT_NAME)_$(filter-out $@,$(MAKECMDGOALS))' --format "{{ .ID }}") sh

## install		Create configuration files and run scripts needed to run the app.
install:
	@cp -n .env.dist .env

## update			Update configuration files and run scripts needed to run the app.
update:
	@make down
	@cp .env.dist .env
	@make up

# https://stackoverflow.com/a/6273809/1826109
%:
	@:
