.PHONY: install start stop tests

install:
	cp .env.example .env
	docker-compose build
	docker-compose up -d
	docker-compose run --no-deps --rm phpfpm composer install
	docker-compose run --no-deps --rm phpfpm php artisan key:generate
	docker-compose run --no-deps --rm phpfpm php artisan migrate --seed
	docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
	docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --tag=datatables-buttons
	docker-compose run --no-deps --rm phpfpm php artisan vendor:publish --tag=livewire-alert:assets
	docker-compose run --no-deps --rm phpfpm php artisan storage:link
	docker-compose run --no-deps --rm phpfpm npm install && npm run dev
	docker-compose run --no-deps --rm phpfpm npm install datatables.net-bs4 datatables.net-buttons-bs4

start:
	docker-compose up -d

stop:
	docker-compose down

tests:
	docker-compose run --no-deps --rm phpfpm php artisan test
