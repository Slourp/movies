.PHONY: up down

up:
	docker-compose -f docker-compose.dev.yml up -d --remove-orphans

stop:
	docker-compose -f docker-compose.dev.yml stop 
