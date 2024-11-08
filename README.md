<p align="center">
<img src="https://www.riverwoodcapital.com/wp-content/uploads/2024/01/logcomex-logo-website.png" width="400" alt="Logcomex">
</p>

## Configuração do Projeto (ambiente local - DOCKER)

Verifique se o Docker e o Docker Composer estão instalados em sua máquina

1. [Docker](https://www.docker.com/)
2. Clone o repositório e crie o arquivo .env com o comando ```.env (cp .env.example .env)```, em seguida, adicione as configurações do banco de dados
3. Rode os comandos 
- ```composer install```
- ```php artisan key:generate```
- ```./vendor/bin/sail up```
4. Acesse o container onde está o projeto ```docker exec -it logcomex-api-laravel.test-1 sh``` e rode os comandos  
- ```php artisan migrate```
- ```php artisan db:seed```
- ```php artisan passport:client --personal```
5. Caso precise, dê permissão na pasta storage (opcional)

## Configuração do Projeto (ambiente local - Artisan Serve)
1. Verifique se a extensão  ext-sodium está instalada
2. Clone o repositório e crie o arquivo .env com o comando ```.env (cp .env.example .env)```, em seguida, adicione as configurações do banco de dados
3. Crie um banco de dados chamado logcomex
4. Altere as configurações do banco de dados (por default o usuário é o ```root``` e a senha é null)
5. Rode os comandos 
- ```composer install```
- ```php artisan key:generate``` 
- ```php artisan migrate```
- ```php artisan db:seed```
- ```php artisan passport:client --personal```
- ```php artisan serve```
6. Caso precise, dê permissão na pasta storage (opcional)

## Postman (opcional)
- Baixe o arquivo LOGCOMEX.postman_collection.json que está na raiz do projeto e importe no Postman

## Links

- API - http://localhost
- MailPit - http://localhost:8025

## Usuário

- ```user@logcomex.com.br / password```
