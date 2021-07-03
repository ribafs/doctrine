# DBAL - Database Abstraction Layer

Existem uma grande quantidade de projetos no site do Doctrine e o DBAL é um deles.

A camada de abstração e acesso de banco de dados Doctrine (DBAL) oferece uma camada de tempo de execução leve e light em torno de uma API semelhante ao PDO e muitos recursos horizontais adicionais, como introspecção de esquema de banco de dados e manipulação por meio de uma API OO.

O PDO é uma biblioteca PHP de abstração de dados para trabalhar com banco de dados, desde que ela foi lançada no PHP 5, mudou-se a forma de como manipular a comunicação com banco de dados, trazendo inúmeras melhorias. A primeira claramente, é deixando a manipulação procedural de lado para focar na orientação a objetos e também as melhorias quanto a facilidade de manipulação de dados. Mas ainda assim, trabalhar com SQL puro pode se tornar maçante e/ou chato, porque, às vezes os comandos são grandes e/ou complexos, dando margem para erros que atrasam nosso desenvolvimento e manutenção das aplicações. O PDO é fantástico para manipular banco de dados, porém, para um banco de dados mais complexo, ele pode não ser adequado.

Eu normalmente uso PDO em meus projetos PHP. Eu gosto porque é uma extensão PHP fácil de usar e compartilha a mesma interface entre todos os bancos de dados. Normalmente eu uso PostgreSQL, mas se eu mudar para mySql ou Oracle, não preciso usar funções diferentes para lidar com as conexões de banco de dados.
PHP tem um ótimo projeto chamado Doctrine2. Doctrine2 é um ORM e usa sua própria camada de abstração de banco de dados chamada DBAL. Na verdade, DBAL não é uma camada de abstração de banco de dados pura. É construído sobre o PDO. É um conjunto de classes PHP que podemos usar e que nos fornece recursos não disponíveis com PDO "puro". Se usarmos Doctrine2, estaremos usando DBAL nos bastidores, mas não precisamos usar Doctrine2 para usar DBAL. Podemos usar DBAL como uma camada de abstração de banco de dados sem qualquer ORM. Obviamente, essa camada PHP extra sobre nossa extensão PDO precisa pagar uma taxa. Vou dar uma olhada nessa taxa neste post. Vou pegar uma das minhas postagens antigas sobre PDO e farei o mesmo com DBAL para ver as diferenças de desempenho.

O fato de o Doctrine DBAL abstrair a API PDO concreta por meio do uso de interfaces que se assemelham muito à API PDO existente torna possível implementar drivers personalizados que podem usar APIs nativas ou criadas pelo próprio. Por exemplo, o DBAL é fornecido com um driver para bancos de dados Oracle que usa a extensão oci8 sob por baixo.

## Suporta os SGBD

    • MySQL 
    • Oracle 
    • Microsoft SQL Server 
    • PostgreSQL 
    • SQLite 

A camada de banco de dados Doctrine 2 pode ser usada independentemente do mapeador relacional de objetos/ORM. Para usar o DBAL, tudo que você precisa é o carregador de classes (autoload) fornecido pelo Composer, para poder carregar as classes automaticamente:

## Instalação

composer require doctrine/dbal

Podemos também baixar de

https://github.com/doctrine/dbal/

Mas idealmente instalar com composer, que facilita a instalação e uso

Uma vantagem que Doctrine DBAL tem sobre PDO simples é que a conexão Doctrine não se conecta ao banco de dados até que a primeira consulta seja executada. Isso significa que você pode criar a conexão no bootstrap de seu aplicativo e, se nenhuma consulta for executada para uma solicitação específica, ele não precisará realmente se conectar ao servidor de banco de dados. O PDO se conecta ao servidor de banco de dados assim que você cria uma instância do PDO.


## Configuração da Conexão

bootstrap.php
```
<?php

require_once 'vendor/autoload.php';

$config = new \Doctrine\DBAL\Configuration();

$connectionParams = array(
    'dbname' => 'testes',
    'user' => 'root',
    'password' => 'root',
    'host' => 'localhost',
    'port' => 3306,
    'charset' => 'utf8',
    'driver' => 'pdo_mysql',
);

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
```

## Insert

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

$conn->insert('customers', array('name' => 'Pedro Brito', 'email' => 'bob@example.com', 'ssn' => '444444444'));


## Update

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

$conn->update('customers', array('name' => 'Antônio', 'email' => 'antonio@example.com', 'ssn' => '55555'), array('id' => 12));

ou
```
$conn->update(
    'teams',
     array('company_name'=> 'NewCompanyName'),
     array('company_name' => 'CurrentCompanyName')
);
```

## Delete
```
require_once '../bootstrap.php';
use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);
$conn->delete('customers', array('id' => 11));
```

## Select One
```
require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

//$row = $conn->fetchNumeric('SELECT * FROM customers WHERE name = ?', array('Antõnio'));
$row = $conn->fetchNumeric('SELECT * FROM customers WHERE id = ?', array(9));
echo $row[1].'-'.$row[2];

ou

$sth = $conn->executeQuery("SELECT * FROM customers WHERE id = 6");
$row = $sth->fetchAssociative();
echo $row['name'].'-'.$row['email'].'-'.$row['ssn'];
```

## Select All
```
require_once '../bootstrap.php';
use Doctrine\DBAL\DriverManager;
$conn = DriverManager::getConnection($connectionParams, $config);

$sql = "SELECT * FROM customers";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

while (($row = $stmt->fetchAssociative()) !== false) {
    echo $row['name'].'-'.$row['email'].'-'.$row['ssn']."\n<br>";
}
```


