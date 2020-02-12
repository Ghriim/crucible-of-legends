DOCKER=docker-compose exec
SF_CONSOLE := ${DOCKER} php bin/console

#Setup automatically docker compose variables
include .env
-include .env.local

create_db:
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists  --env=dev
	$(SF_CONSOLE) doctrine:database:create  --env=dev
	$(SF_CONSOLE) doctrine:schema:create  --env=dev
	$(SF_CONSOLE) hautelook:fixtures:load --purge-with-truncate --no-interaction --env=dev

mysql.connect.default:
	@$(DOCKER) mysql-default /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DEFAULT_DB_NAME'