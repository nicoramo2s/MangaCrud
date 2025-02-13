# 📚 API REST para Gestión de Mangas

Este proyecto es una API REST en Laravel para gestionar el inventario de mangas en una tienda.

## 🚀 Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu_usuario/MangaCrud.git
   cd MangaCrud
   ```

2. Instalar dependencias:
   ```bash
   composer install
   ```

3. Configurar el archivo `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configurar la base de datos en `.env` y ejecutar migraciones:
   ```bash
   php artisan migrate
   ```

5. Ejecuta el seeder:
   ```bash
   php artisan db:seed
   ```

6. Crear un enlace simbólico para el almacenamiento de imágenes:
   ```bash
   php artisan storage:link
   ```

7. Iniciar el servidor:
   ```bash
   php artisan serve
   ```

## 🔑 Autenticación

- La API usa **Laravel Sanctum** para autenticación.
- Accede a la ruta
```http
POST /api/login
```
- Logeate con estos datos y obten tu token de acceso.
```
{
   "email": "usuario@test.com",
   "password": "password"
}
```

- Para acceder a las rutas protegidas, se debe enviar un token en el header `Authorization: Bearer TOKEN`.

## 📌 Endpoints

### 🔍 Obtener todos los mangas
```http
GET /api/mangas
```

### ➕ Crear un manga
```http
POST /api/mangas
```
📥 **Parámetros:**
| Campo          | Tipo     | Requerido | Descripción |
|---------------|---------|-----------|-------------|
| titulo         | string  | ✅        | Título del manga |
| portada   | file    | ❌        | Imagen de portada (JPEG, PNG, JPG, máx. 2MB) |
| categoria_id   | string | ✅        | ID de la categoría |
| subcategoria_id| string | ✅        | ID de la subcategoría |


### 🔍 Obtener un manga específico
```http
GET /api/mangas/{id}
```

### ✏️ Actualizar un manga
```http
PUT /api/mangas/{id}
```
📥 **Parámetros:**
- **titulo** (string) Opcional
- **portada** (file) Opcional
- **categoria_id** (string) Opcional
- **subcategoria_id** (string) Opcional



### 🗑️ Eliminar un manga
```http
DELETE /api/mangas/{id}
```


## ⚙ Tecnologías Usadas
- Laravel 11
- Laravel Sanctum (Autenticación)
- SQLite (Base de datos)
- Postman o cURL (Pruebas API)

---

