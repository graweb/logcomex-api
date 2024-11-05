<p align="center">
<img src="https://www.riverwoodcapital.com/wp-content/uploads/2024/01/logcomex-logo-website.png" width="400" alt="Logcomex">
</p>

## Configuração do Projeto (ambiente local)

Verifique se o Docker e o Docker Composer estão instalados em sua máquina

1. [Docker](https://www.docker.com/)
2. Clone o repositório e crie o arquivo .env com o comando ```.env (cp .env.example .env)```, em seguida, adicione as configurações do banco de dados
3. Rode os comandos 
- ```composer install```
- ```php artisan key:generate```
- ```./vendor/bin/sail up```
4. Acesse o container onde está o projeto ```docker exec -it logcomex-api-laravel.test-1 sh``` e rode os comandos  
- ```php artisan passport:client --personal```
- ```php artisan migrate```
- ```php artisan db:seed```
5. Caso precise, dê permissão na pasta storage (opcional)

## Postman
- Baixe o arquivo LOGCOMEX.postman_collection.json que está na raiz do projeto e importe no Postman

## Links

- API - http://localhost
- MailPit - http://localhost:8025

## Usuário

- ```user@logcomex.com.br / password```
