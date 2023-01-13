https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/dql-doctrine-query-language.html



//Após criar o arquivo composer.json
composer install

//Para prepara o sistema de versionamento em banco
composer require doctrine/migrations


//Local php_ini
php --ini


sudo apt install php-cli php-common php-pgsql php-curl php-mbstring php-xml php-bcmath php-sqlite3



Para executar use

//Arquivo responsável por comandos do entity
php bin/doctrine.php

//Informações das entidades e se estão ok
php bin/doctrine.php orm:info

//descrição de uma entidade
php bin/doctrine.php orm:mapping:describe Student


//Cria o banco de dados
php bin/doctrine.php orm:schema-tool:create

//Atualiza o banco de dados
php bin/doctrine.php orm:schema-tool:update --force

//Mostra os comandos que serão usados para atualizar o banco
php bin/doctrine.php orm:schema-tool:update --dump-sql

//Validar o schema do bano -SQL Lite têm alguns problemas
php bin/doctrine.php orm:validate-schema


// Executar sqlite
php bin/doctrine.php dbal:run-sql "SELECT * FROM STUDENT"

//migrations usos aplica o versionamento
php vendor/bin/doctrine-migrations

//migrations gerar file onde adiciona os comandos
php vendor/bin/doctrine-migrations migrations:generate

//gera diferenças do ORM em relação ao migrate
php vendor/bin/doctrine-migrations migrations:diff

//limpar o cache do app
php bin/doctrine.php orm:clear-cache:metadata

//container mysql
docker mysql $docker run –rn –name=tmp_mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=rootpw -e MYSQL_DATABASE=students mysql

//show table pgsql
php bin/doctrine.php dbal:run-sql "SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema'"