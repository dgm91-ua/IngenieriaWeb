# Configuración y despliegue del entorno de Laravel en Docker para Windows

# Configuración inicial
setup:
	@$(MAKE) build
	@$(MAKE) up
	@$(MAKE) composer-update

# Construir imágenes de Docker
build:
	docker-compose build --no-cache --force-rm

# Iniciar contenedores en segundo plano
up:
	docker-compose up -d

# Detener contenedores sin eliminarlos
stop:
	docker-compose stop

# Detener y eliminar contenedores, redes y volúmenes asociados
down:
	docker-compose down

# Actualizar dependencias de Composer
composer-update:
	docker exec laravel-app bash -c "composer update"

# Migrar la base de datos y ejecutar seeders
data:
	docker exec laravel-app bash -c "php artisan migrate"
	docker exec laravel-app bash -c "php artisan db:seed"

# Limpiar cachés de Laravel
cache-clear:
	docker exec laravel-app bash -c "php artisan config:clear"
	docker exec laravel-app bash -c "php artisan cache:clear"
	docker exec laravel-app bash -c "php artisan route:clear"
	docker exec laravel-app bash -c "php artisan view:clear"
