https://symfony.com/doc/current/setup.html
==============================================================================================
                                    INSTALAÇÃO
==============================================================================================
# run this if you are building a traditional web application (doctrine, log complexo, web ...)
composer create-project symfony/skeleton:"6.1.*" my_project_directory
cd my_project_directory
composer require webapp


# Comando Executado
composer create-project symfony/skeleton:"6.1.*" controle_series_symfony
cd controle_series_symfony
composer require webapp

# Iniciando o serviço
php -S 0.0.0.0:8123 -t public
==============================================================================================
==============================================================================================
==============================================================================================



==============================================================================================
								CONTROLLER
==============================================================================================

# Criar um Controller - Rota e template
php bin/console make:controller OlaMundoController

# DUMP AND DIE
dd();
==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								XSS
==============================================================================================
# XSS ou ataque de script ocorre ao postar um texto que possui scripts, para isso precisa remover a sintaxe, o PHP possui a função htmlentities que faz esse trabalho
	htmlentities($value)

# Exemplo acima é pra saída mas quando é entrada não usa super global como
	$_POST['depoimento'];
# Use essa forma
	filter_input(INPUT_POST, 'depoimento', FILTER_SANITIZE_STRING);

==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								WEBPACK
==============================================================================================
# Tipo um composer para o front onde instala várias dependências nesse caso usamos o Symfony full stack use o comando abaixo para terminar a instalação, também tenha o node instalado (Instalar o node, sempre escolha par e LTS), vamos usar as dependências do bootstrap
composer require symfony/webpack-encore-bundle
node install
# caso erro no node install
rm -rf node_modules package-lock.json && npm install

# depois
npm install bootstrap --save-dev
npm install sass-loader@^13.0.0 sass --save-dev

# em webpack.config.js descomete
.enableSassLoader()
.addStyleEntry('style','./assets/styles/app.scss');

# em asset/styles mudar o app.css para app.scss apagar seu conteúdo e substituir por
@import "~bootstrap/scss/bootstrap";

# dentro da pasta asset deixar só a pasta styles

# agora
npm run dev
==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								CREATE ENTITY
==============================================================================================
# Comando via console symfony
php bin/console make:entity Series

# por default ele já cria id então basta criar outros campos


# informação da Conexão
/sda5/code/Alura/controle_series_symfony/config/packages/doctrine.yaml
# terá uma váriavel DATABASE_URL que poderá ser definida em .env porém comente ali e defina ela no arquivo .env.local

# Após executar o comando
php bin/console doctrine:database:create

# Criar os Migrations
php bin/console make:migration

# Executar os migrations
php bin/console doctrine:migrations:migrate

# Se quiser rodar um sql
php bin/console doctrine:query:sql "SELECT * FROM series"
==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								ROTAS
==============================================================================================
# Para ver as rotas
php bin/console debug:router


# Para usar DELETE das rotas
# Em /config/packages/framework.yaml habilite a tag http_method_override
http_method_override: true
# Na abertura do form logo abaixo inclua
	<input type="hidden" name="_method" value="DELETE">

==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								FORM
==============================================================================================
https://symfony.com/doc/current/forms.html

# Criar formulário via comando
php bin/console make:form SeriesType

==============================================================================================
==============================================================================================
==============================================================================================




==============================================================================================
								AUTHENTICATION
==============================================================================================
# Criar os Usuários
php bin/console make:user

# Criar o controller
php bin/console make:controller Login

# bundle de login - tela de criação de usuário
composer require symfonycasts/verify-email-bundle

# Após configura o bundle
php bin/console make:registration-form