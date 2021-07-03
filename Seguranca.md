# Segurança com Doctrine

Permitir que os usuários do seu site se comuniquem com um banco de dados pode ter implicações de segurança das quais você deve estar ciente. Os bancos de dados permitem comandos muito poderosos que nem todos os usuários do seu site deveriam ser capazes de executar. Além disso, os dados em seu banco de dados provavelmente contêm informações que não devem ser visíveis a todos com acesso ao site.

O problema de segurança mais perigoso com relação aos bancos de dados é a possibilidade de injeções de SQL. Uma brecha na segurança de injeção de SQL permite que um invasor execute novas instruções SQL ou modifique as existentes para acessar informações que ele não tem permissão para acessar.

Nem Doctrine DBAL nem ORM podem prevenir tais ataques se você for descuidado como desenvolvedor. Esta seção explica os problemas de injeção de SQL e como evitá-los.

## SQL Injection

APIs seguras e inseguras para entrada do usuário

Uma biblioteca de banco de dados toca naturalmente a classe de vulnerabilidades de segurança de injeção de SQL. Você deve ler as seguintes informações cuidadosamente para entender como o Doctrine pode e não pode ajudá-lo a prevenir a injeção de SQL.

Em geral, você deve assumir que as APIs no Doctrine não são seguras para entrada do usuário. Existem, contudo, algumas exceções.

## Errado: Concatenação de String

Você nunca deve construir suas consultas dinamicamente e concatenar a entrada do usuário em sua consulta SQL ou DQL. Por exemplo:

// Muito errado

$sql = "SELECT * FROM users WHERE name = '" . $_GET['username']. "'";

Um invasor pode injetar qualquer valor na variável GET para modificar a consulta de acordo com suas necessidades.

A DQL também não protege contra SQL Injection.

Embora o DQL seja um invólucro em torno do SQL que pode evitar algumas implicações de segurança, o exemplo anterior também é uma ameaça às consultas DQL.

Nesse cenário, um invasor ainda pode passar um nome de usuário definido como 'OR 1 = 1 e criar uma consulta DQL válida. Embora o DQL faça uso de funções de cotação quando literais são usados em uma instrução DQL, permitir que o invasor modifique a instrução DQL com literais válidos não pode ser detectado pelo analisador DQL, é sua responsabilidade.

## Right: Prepared Statements (esta é a forma correta)

Exemplos usando prepared statments com SQL e DQL
```
<?php
// SQL Prepared Statements: Positional
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $connection->prepare($sql);
$stmt->bindValue(1, $_GET['username']);
$stmt->execute();

// SQL Prepared Statements: Named
$sql = "SELECT * FROM users WHERE username = :user";
$stmt = $connection->prepare($sql);
$stmt->bindValue("user", $_GET['username']);
$stmt->execute();

// DQL Prepared Statements: Positional
$dql = "SELECT u FROM User u WHERE u.username = ?1";
$query = $em->createQuery($dql);
$query->setParameter(1, $_GET['username']);
$data = $query->getResult();

// DQL Prepared Statements: Named
$dql = "SELECT u FROM User u WHERE u.username = :name";
$query = $em->createQuery($dql);
$query->setParameter("name", $_GET['username']);
$data = $query->getResult();
```
Você pode ver que isso é um pouco mais tedioso de escrever, mas é a única maneira de escrever consultas seguras. Se você estiver usando apenas o DBAL, também existem métodos auxiliares que simplificam muito o uso:
```
<?php
// bind parameters and execute query at once.
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $connection->executeQuery($sql, array($_GET['username']));
```
Também existe executeStatement, que não retorna uma instrução, mas o número de linhas afetadas.

Além dos parâmetros de ligação, você também pode passar o tipo da variável. Isso permite que o Doctrine ou o fornecedor subjacente não apenas escape, mas também converta o valor para o tipo correto. Consulte os documentos sobre consulta e DQL nos respectivos capítulos para obter mais informações.

## Correto: Quoting/Escaping values

Embora tenhamos dito anteriormente que a concatenação de string está errada, há uma maneira de fazer isso corretamente usando o método Connection # quote:
```
<?php 
// Parameter quoting 
$sql = "SELECT * FROM users WHERE name = " . $connection->quote($_GET['username']);
```
Este método está disponível apenas para SQL, não para DQL. Para DQL, você sempre é incentivado a usar instruções preparadas não apenas por segurança, mas também por motivos de armazenamento em cache.


