# laravel_asaas_test

1. Abrir o arquivo docker-compose.yml e alterar os dados do Banco MySQL.
2. Abrir o arquivo .env.example e alterar também os dados do MySQL. 
3. Rodar o comando composer install na raiz do projeto
4. Rodar o comando docker-compose up -d na raiz do projeto
5. Rodar o comando docker ps e pegar o id referente ao container docker_laravel
6. Rodar o comando docker exec -it [container_id] bash
7. Rodar o comando php artisan migrate
