## Alguns comandos do Doctrine

O Doctrine tem muitos comandos para serem usados na linha de comando

## Ver a lista de comandos

php vendor/bin/doctrine

## Criar esquema do banco

vendor/bin/doctrine orm:schema-tool:create

ou

php vendor/bin/doctrine orm:schema-tool:create

## Remover esquema do banco (removerá todas as tabelas)

php vendor/bin/doctrine orm:schema-tool:drop --force

    orm:schema-tool:drop --force to execute the command
     orm:schema-tool:drop --dump-sql to dump the SQL statements to the screen


## Adicionar registros

cd crud

php create_customer.php 'Ribamar FS' 'ribafs@gmail.com' '12312345'
php create_customer.php 'Elias EF' 'elias@gmail.com' '12317745'

## Listar clientes

php list_customers.php

## Exibir um customers

php show_customer.php id

php show_customer.php 1

## Atualizar um customer

Alterar o nome do customer com id = 1

php update_customer.php <id> <new-name>|<new-email>|<new-ssn>

php update_customer.php 1 'Ribamar FS2'

Alterar o e-mail do customer com id = 1

php update_customer.php 1 'Ribamar FS' 'ribafs2@gmail.com' '12121'

## Remover o bancoc de dados

php vendor/bin/doctrine orm:schema:drop --force

## Geração de arquivo de dump da base de dados

php vendor/bin/doctrine orm:schema-tool:create --dump-sql > dump.sql

Criar o script em uma única linha

## Dropar e recriar esquema

php vendor/bin/doctrine orm:schema-tool:drop --force
php vendor/bin/doctrine orm:schema-tool:create

## Mostrar SQL

php vendor/bin/doctrine orm:schema-tool:create --dump-sql

## Exportar SQL

php vendor/bin/doctrine orm:schema-tool:create --dump-sql > dump.sql

## Geração de entidades

$ php doctrine orm:generate-entities
$ php doctrine orm:generate-entities --update-entities
$ php doctrine orm:generate-entities --regenerate-entities

Este comando não é adequado para uso constante. É um pequeno auxiliar e não suporta muito bem todos os casos extremos de mapeamento. Você ainda precisa colocar trabalho em suas entidades depois de usar este comando.

É possível usar o EntityGenerator no código que você já escreveu. Não será perdido. O EntityGenerator apenas anexará o novo código ao seu arquivo e não excluirá o código antigo. No entanto, essa abordagem ainda pode estar sujeita a erros e sugerimos que você use repositórios de código como GIT ou SVN para fazer backups de seu código.

Faz sentido gerar o código de entidade se você estiver usando entidades apenas como objetos de acesso a dados e não colocar muita lógica adicional nelas. No entanto, se você estiver colocando muito mais lógica nas entidades, deve evitar o uso do gerador de entidades e codificar suas entidades manualmente.

Mesmo se você especificou opções de herança em seus arquivos de mapeamento XML ou YAML, o gerador não pode gerar as classes base e filho para você corretamente, porque ele não sabe qual classe deve estender qual. Você tem que ajustar o código de entidade manualmente para que a herança funcione!

## Validação de esquemas

php vendor/bin/doctrine orm:validate-schema

## Help sobre generate-entities

php vendor/bin/doctrine orm:generate-entities --help


The following Commands are currently available:

    help Displays help for a command (?)
    list Lists commands
    dbal:import Import SQL file(s) directly to Database.
    dbal:run-sql Executes arbitrary SQL directly from the command line.
    orm:clear-cache:metadata Clear all metadata cache of the various cache drivers.
    orm:clear-cache:query Clear all query cache of the various cache drivers.
    orm:clear-cache:result Clear result cache of the various cache drivers.
    orm:convert-d1-schema Converts Doctrine 1.X schema into a Doctrine 2.X schema.
    orm:convert-mapping Convert mapping information between supported formats.
    orm:ensure-production-settings Verify that Doctrine is properly configured for a production environment.
    orm:generate-entities Generate entity classes and method stubs from your mapping information.
    orm:generate-proxies Generates proxy classes for entity classes.
    orm:generate-repositories Generate repository classes from your mapping information.
    orm:run-dql Executes arbitrary DQL directly from the command line.
    orm:schema-tool:create Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output.
    orm:schema-tool:drop Processes the schema and either drop the database schema of EntityManager Storage Connection or generate the SQL output.
    orm:schema-tool:update Processes the schema and either update the database schema of EntityManager Storage Connection or generate the SQL output.

For these commands are also available aliases:

    orm:convert:d1-schema is alias for orm:convert-d1-schema.
    orm:convert:mapping is alias for orm:convert-mapping.
    orm:generate:entities is alias for orm:generate-entities.
    orm:generate:proxies is alias for orm:generate-proxies.
    orm:generate:repositories is alias for orm:generate-repositories.

	

Console also supports auto completion, for example, instead of orm:clear-cache:query you can use just o:c:q.
