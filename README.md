##  Ejecute los siguientes pasos para ejecutar el ejemplo de manera local

1. Clone el repositorio
```
git clone  https://github.com/atilas88/laravel_jwt_swagger.git
```
2. Dentro de la carpeta del proyecto:
```
composer install
```
3. Cree el archivo .env
```
cp .env.example .env
```
Dentro de .env configurar la base de datos y copiar L5_SWAGGER_GENERATE_ALWAYS = true
4. Genere la llave de la app
```
php artisan key:generate
```
5. Genere el token jwt
```
php artisan jwt:secret
```
6. Ejecute las migraciones
```
php artisan migrate:fresh --seed
```
7. Inicie la app
```
php artisan serve
```
8. Consulte el api ejecutando:
http://ip_serv:puerto/api/documentation

Hacer login con el usuario user@gmail.com y el password es del 1 al 6. Con el access_token generado autorizar el resto del Api en el botón **Authorize** escribiendo *Bearer access_token* en el input value.

