default: run

run:docker_up composer_install copy_env create_keys migrate seed test front_run

docker_up:
	docker compose up -d --build

composer_install:
	docker compose exec app sh -c 'composer install'

copy_env:
ifneq ($(wildcard .env),)
	echo '.env exists'
else
	echo 'Copying .env.example to .env' && cp .env.example .env
endif

create_keys:
	docker compose exec app sh -c 'php artisan key:generate'

migrate:
	docker compose exec app sh -c '(php artisan migrate:install -q -n || true) && php artisan migrate'

seed:
	docker compose exec app sh -c 'php artisan db:seed'

test:
	docker compose exec app sh -c '(touch database/test_db.sqlite || true) && composer test'

front_run:
	npm install && npm run dev
