This is the code for the Doctrine 2 ORM tutorial.

Last Update: Tutorial is now using Composer only

You can find the tutorial at:

https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html

## Installation:

```bash
git clone https://github.com/doctrine/doctrine2-orm-tutorial.git  # or: git clone git@github.com:doctrine/doctrine2-orm-tutorial.git

cd doctrine2-orm-tutorial

composer install
```

## Database setup

bootstrap.php

database configuration parameters

This to sqlite

## Generating the Database Schema

Criar as tabelas no banco, de acordo com os 3 arquivos em src

vendor/bin/doctrine orm:schema-tool:create

Então aparece:

 ! [CAUTION] This operation should not be executed in a production environment!
 Creating database schema...
 [OK] Database schema created successfully! 

Reclamou mas criou o esquema. Vejamos:

cd doctrine2-orm-tutorial

sqlite3 db.sqlite

.tables
bug_product  bugs         products     users

Help - .help

select * from bugs;

Sair .quit

Nada retorna, pois ainda não temos registros na tabela bugs.

Caso precise modificar os arquivos com metadados de src, então execute

vendor/bin/doctrine orm:schema-tool:drop --force

vendor/bin/doctrine orm:schema-tool:create

ou

vendor/bin/doctrine orm:schema-tool:update --force

Atualizar o esquema no banco

vendor/bin/doctrine orm:schema-tool:update --force --dump-sql


## Adicionar registros

php create_product.php ORM
php create_product.php DBAL

Observe que o script create_product.php tem a seguinte variável:

$newProductName = $argv[1];

Que é passada para o setName(), por isso devemos executar o arquivo passando um parâmetro, no caso ORM e DBAL.


