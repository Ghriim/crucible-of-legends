SF_CONSOLE := php bin/console

#Setup automatically docker compose variables
include .env
-include .env.local

create_db:
	@$(SF_CONSOLE) doctrine:database:drop --force --if-exists  --env=dev
	@$(SF_CONSOLE) doctrine:database:create  --env=dev
	@$(SF_CONSOLE) doctrine:schema:create  --env=dev
	@$(SF_CONSOLE) hautelook:fixtures:load --purge-with-truncate --no-interaction --env=dev
