# Proyecto Laravel: LuxuryParfum

Este repositorio contiene el código fuente de LuxuryParfum, un proyecto desarrollado con el framework Laravel, que utiliza MySQL como base de datos y Blade como motor de plantillas.

## Descripción

LuxuryParfum es una aplicación web enfocada en la venta de perfumes de alta gama. Incluye:

- Catálogo de productos y categorías
- Carrito de compras y pedidos
- Sección de administración con CRUD de productos, categorías y usuarios
- Autenticación de usuarios con roles (admin, customer)
- Uso de GitHub para control de versiones y asignación de tareas

## Requisitos

-PHP 8.x o superior
-Composer (para la gestión de dependencias de PHP)
-MySQL (o cualquier otra base de datos soportada por Laravel, ajustando .env)
-Node.js y npm (si quieres compilar tus assets con Vite o Laravel Mix)

## Instalación

Sigue estos pasos para poner en marcha la aplicación:

Clonar el repositorio:
```bash
git clone https://github.com/dgm91-ua/IngenieriaWeb.git
cd LuxuryParfum
```

Instalar dependencias de PHP:
```bash
composer install
```
Copiar y configurar el archivo .env:
```bash
cp .env.example .env
```

Luego, edita el archivo .env para ajustar la configuración de la base de datos, por ejemplo:
```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

Ejecutar migraciones (y, opcionalmente, seeders):
```bash
php artisan migrate
php artisan db:seed
```

Instalar dependencias de Node (opcional, si usas assets con Vite):
```bash
npm install
npm run dev
npm run build
```

Crear el enlace simbólico de storage (si vas a manejar archivos subidos):
```bash
php artisan storage:link
```

Levantar el servidor de desarrollo:
```bash
php artisan serve
```

## Estructura de la Aplicación

- app/Models contiene los modelos Eloquent (por ejemplo, Product, Category, User).
- app/Http/Controllers agrupa los controladores de la aplicación.
- Controladores de administración (CRUD de productos, categorías, usuarios).
- Controladores de la parte pública (catálogo, carrito).
- resources/views almacena las plantillas Blade (.blade.php).
- Se subdividen en carpetas como admin/products, admin/categories, etc.
- routes/web.php define las rutas principales de la aplicación.

# Persona encargada de generar todo
 
 ```
    DAVID GARCÍA MARTÍNEZ
 ```