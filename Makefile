# Makefile for Docker Nginx PHP Composer MySQL

include .env

# MySQL
MYSQL_DUMPS_DIR=data/db/dumps

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  code-sniff          Check the API with PHP Code Sniffer (PSR2)"
	@echo "  clean               Clean directories for reset"
	@echo "  composer-up         Update PHP dependencies with composer"
	@echo "  docker-start        Create and start containers"
	@echo "  docker-stop         Stop and clear all services"
	@echo "  logs                Follow log output"
	@echo "  mysql-dump          Create backup of whole database"
	@echo "  mysql-restore       Restore backup from whole database"

init:
	@$(shell cp -n $(shell pwd)/web/app/composer.json.dist $(shell pwd)/web/app/composer.json 2> /dev/null)

clean:
	@rm -Rf data/db/mysql/*
	@rm -Rf $(MYSQL_DUMPS_DIR)/*
	@rm -Rf web/app/vendor
	@rm -Rf web/app/composer.lock
	@rm -Rf web/app/doc
	@rm -Rf web/app/report
	@rm -Rf etc/ssl/*

composer-up:
	@docker run --rm -v $(shell pwd)/web/app:/app composer update

docker-start: init
	docker-compose up -d

docker-stop:
	@docker-compose down -v
	@make clean

logs:
	@docker-compose logs -f

mysql-dump:
	@mkdir -p $(MYSQL_DUMPS_DIR)
	@docker exec $(shell docker-compose ps -q mysqldb) mysqldump --all-databases -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" > $(MYSQL_DUMPS_DIR)/db.sql 2>/dev/null
	@make resetOwner

mysql-restore:
	@docker exec -i $(shell docker-compose ps -q mysqldb) mysql -u"$(MYSQL_ROOT_USER)" -p"$(MYSQL_ROOT_PASSWORD)" < $(MYSQL_DUMPS_DIR)/db.sql 2>/dev/null

resetOwner:
	@$(shell chown -Rf $(SUDO_USER):$(shell id -g -n $(SUDO_USER)) $(MYSQL_DUMPS_DIR) "$(shell pwd)/etc/ssl" "$(shell pwd)/web/app" 2> /dev/null)

.PHONY: clean test code-sniff init