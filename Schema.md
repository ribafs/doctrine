# Schema Manager
```
<?php 
$sm = $conn->getSchemaManager();


$databases = $sm->listDatabases();

$sequences = $sm->listSequences();

$sequences = $sm->listSequences('dbname');

<?php
foreach ($sequences as $sequence) {
    echo $sequence->getName() . "\n";
}

// Listar campos

<?php
$columns = $sm->listTableColumns('user');

//Tipos da dados

foreach ($columns as $column) {
    echo $column->getName() . ': ' . $column->getType() . "\n";
}

Doctrine\DBAL\Schema\Table

$table = $sm->listTableDetails('user');

$table->addColumn('email_address', 'string');

//Listar FK

Doctrine\DBAL\Schema\ForeignKeyConstraint

$foreignKeys = $sm->listTableForeignKeys('user');

foreach ($foreignKeys as $foreignKey) {
    echo $foreignKey->getName() . ': ' . $foreignKey->getLocalTableName() ."\n";
}

foreach ($foreignKeys as $foreignKey) {
    echo $foreignKey->getName() . ': ' . $foreignKey->getLocalTableName() ."\n";
}

//Listar índices

Doctrine\DBAL\Schema\Index

$indexes = $sm->listTableIndexes('user');

<?php
foreach ($indexes as $index) {
    echo $index->getName() . ': ' . ($index->isUnique() ? 'unique' : 'not unique') . "\n";
}

//Listar tabelas

Doctrine\DBAL\Schema\Table 

$tables = $sm->listTables();

Cada instância de Doctrine \ DBAl \ Schema \ Table é preenchida com informações fornecidas por todos os métodos acima. Portanto, ele encapsula uma matriz de instâncias de Doctrine \ DBAL \ Schema \ Column que podem ser recuperadas com o método getColumns ():

foreach ($tables as $table) {
    echo $table->getName() . " columns:\n\n";
    foreach ($table->getColumns() as $column) {
        echo ' - ' . $column->getName() . "\n";
    }
}

//Criar esquema

Doctrine\DBAL\Schema\Schema

$fromSchema = $sm->createSchema();

$toSchema = clone $fromSchema;
$toSchema→dropTable('user');

$sql = $fromSchema->getMigrateToSql($toSchema, $conn→getDatabasePlatform());
```


