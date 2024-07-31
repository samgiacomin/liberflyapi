##  Execute os passos para rodar o projeto

1. Clonar
```
git clone  https://github.com/atilas88/laravel_jwt_swagger.git
```
2. Dentro da pasta raiz execute:
```
composer install
```
3. Gerar a chave do app
```
php artisan key:generate
```
4. Gerar o token jwt
```
php artisan jwt:secret
```
5. Executar as migrações
```
php artisan migrate:fresh --seed
```
6. Iniciar o app
```
php artisan serve
```
7. Consulte a api executando:
http://localhost:8000/api/documentation

Fazer login com o usuario user@gmail.com e password "123456"

