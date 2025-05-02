# Aplicación de Activos Fijos con Laravel y PostgreSQL

Esta es una aplicación para gestionar activos fijos utilizando Laravel como framework y PostgreSQL como base de datos.

## Requisitos

- PHP 8.0 o superior
- Composer
- PostgreSQL

## Instalación

1. Clona este repositorio en tu máquina local.
2. Ejecuta `composer install` para instalar las dependencias de Laravel.
3. Configura tu base de datos en el archivo `.env`.
4. Ejecuta las migraciones con el comando:  
   `php artisan migrate`
5. (Opcional) Si tienes datos de prueba, puedes ejecutar el seeder:  
   `php artisan db:seed`

## Uso

Una vez que la instalación esté lista, puedes acceder a la página de activos a través de la siguiente URL:

        http://localhost/activos

### Funcionalidades Implementadas

Se cumplio con las caracteristicas solicitadas en el proyecto:

1. **Tablas de la base de datos**:
   - `activo`: Contiene los campos `id`, `nombre`, `codigo`, `descripcion`, `cantidad_inicial`, `created_at`, `updated_at`.
   - `baja`: Contiene los campos `id`, `cantidad`, `activo_id`, `motivo`, `fecha`, `created_at`, `updated_at`.

2. **Lista de activos**:
   - Se muestran los campos `Código`, `Nombre`, y `Stock Actual`.
   
3. **Bajas de activos**:
   - Se puede dar de baja a un activo, ingresando la cantidad a dar de baja, el motivo y la fecha.
   - Después de dar de baja un activo, el stock actual se actualiza automáticamente restando las bajas registradas del stock inicial.

4. **Edición de activos**:
   - Es posible editar los datos de un activo, como `nombre` y `descripcion`, y actualizarlos en la base de datos.

5. **Buscador de activos**:
   - Se incluye un buscador para filtrar activos por `nombre` o `código`.

6. **Agregar un nuevo activo**:
   - Se puede agregar un nuevo activo con los siguientes campos: `nombre`, `descripcion`, `cantidad_inicial`.
   - El campo `código` se genera automáticamente en el formato `CM001`, `CM002`, `CM003`, y así sucesivamente.

