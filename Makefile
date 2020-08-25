DOCKER=docker-compose
DOCKER_EXEC= ${DOCKER} exec
SF_CONSOLE := ${DOCKER_EXEC} php bin/console

include .env
-include .env.local

reup:
	docker-compose down --remove-orphan
	docker-compose up -d
	docker ps

start_working: vendor
	sleep 10
	make create_db

vendor: up
	@$(DOCKER_EXEC) php composer install

up: down
	@$(DOCKER) up -d

down:
	@$(DOCKER) down --remove-orphan

create_db:
	$(SF_CONSOLE) doctrine:mongodb:schema:update --env=dev
	$(SF_CONSOLE) load-odm-fixtures

reset_db_mongo:
	$(SF_CONSOLE) doctrine:mongodb:schema:drop --env=dev
	$(SF_CONSOLE) doctrine:mongodb:schema:update --env=dev
	$(SF_CONSOLE) load-odm-fixtures

mysql.connect.default:
	@$(DOCKER_EXEC) mysql-default /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DEFAULT_DB_NAME'

mongo.connect.default:
	@$(DOCKER_EXEC) mongo-default /bin/bash -c 'mongo'
