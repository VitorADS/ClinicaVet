Clinica veterinária
Documentações feitas pelo Astah UML. (https://astah.net/downloads/)

<h4>Sistema desevolvido com PHP framework Symfony.<h4><hr>

<p>Necessario ter o docker e docker compose instalado.</p>
<p>Em seguida apenas rodar docker compose up -d.</p>
<p>Verificar o ip do banco de dados, alterar o nome do arquivo env.local para tirar o .example</p>
<p>Alterar o arquivo .env.local para DATABASE_URL="postgresql://postgres:123456@172.28.0.3:5432/clinica?serverVersion=16&charset=utf8"</p>
<p>Necessario entrar no container do php fpm e rodar o seguinte comando: composer install</p>
<p>Caso queira pode-se alterar o usuario e senha do banco no docker-compose.yml</p>
<p>Verificar se a base de dados clinica esta criada e entao rodar as migrations: php bin/console doctrine:migrations:migrate</p>
<p>No arquivo HomeController.php pode-se descomentar o meta atributo de rota, entao e possivel registrar o primeiro profissional em /register.</p>
