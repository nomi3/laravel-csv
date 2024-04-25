build:
	docker compose build --no-cache --force-rm
up:
	docker compose up -d
down:
	docker compose down
app:
	docker compose exec app ash
fresh:
	docker compose exec app php artisan migrate:fresh --seed
test:
	docker compose exec app php artisan config:clear & docker compose exec app php artisan test