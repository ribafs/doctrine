# Trechos de código de exemplo para Doctrine/DBAL

```
$sql = "SELECT * FROM articles";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

while (($row = $stmt->fetchAssociative()) !== false) {
    echo $row['headline'];
}


Prepare

$sql = "SELECT * FROM articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $id);
$stmt->execute();

$sql = "SELECT * FROM articles WHERE id = ? AND status = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $id);
$stmt->bindValue(2, $status);
$stmt->execute();

$sql = "SELECT * FROM users WHERE name = :name OR username = :name";
$stmt = $conn->prepare($sql);
$stmt->bindValue("name", $name);
$stmt->execute();

$date = new \DateTime("2011-03-05 14:00:21");
$stmt = $conn->prepare("SELECT * FROM articles WHERE publish_date > ?");
$stmt->bindValue(1, $date, "datetime");
$stmt->execute();

$stmt = $conn->executeQuery('SELECT * FROM articles WHERE id IN (?)',
    array(array(1, 2, 3, 4, 5, 6)),
    array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
);

$stmt = $conn->executeQuery('SELECT * FROM articles WHERE id IN (?, ?, ?, ?, ?, ?)',
    array(1, 2, 3, 4, 5, 6),
    array(
        ParameterType::INTEGER,
        ParameterType::INTEGER,
        ParameterType::INTEGER,
        ParameterType::INTEGER,
        ParameterType::INTEGER,
        ParameterType::INTEGER,
    )
);

$statement = $conn->prepare('SELECT * FROM user');
$resultSet = $statement->execute();
$users = $resultSet->fetchAllAssociative();

$count = $conn->executeStatement('UPDATE user SET username = ? WHERE id = ?', array('jwage', 1));
echo $count; // 1

$statement = $conn->executeQuery('SELECT * FROM user WHERE username = ?', array('jwage'));
$user = $statement->fetchAssociative();

$users = $conn->fetchAllAssociative('SELECT * FROM user');

$users = $conn->fetchAllKeyValue('SELECT username, email FROM user');

$users = $conn->fetchAllAssociativeIndexed('SELECT id, username, email FROM user');

$user = $conn->fetchNumeric('SELECT * FROM user WHERE username = ?', array('jwage'));

$username = $conn->fetchOne('SELECT username FROM user WHERE id = ?', array(1), 0);
echo $username; // jwage

$user = $conn->fetchAssociative('SELECT * FROM user WHERE username = ?', array('jwage'));

foreach ($conn->iterateKeyValue('SELECT username, email FROM user') as $username => $email) {
    // ...
}

foreach ($conn->iterateAssociativeIndexed('SELECT id, username, email FROM user') as $id => $data) {
    // ...
}

$conn->delete('user', array('id' => 1));

$conn->insert('user', array('username' => 'jwage'));

$conn->update('user', array('username' => 'jwage'), array('id' => 1));


use Doctrine\DBAL\ParameterType;

$quoted = $conn->quote('value');
$quoted = $conn->quote('1234', ParameterType::INTEGER);


QueryBuilder

$conn = DriverManager::getConnection(array(/*..*/));
$queryBuilder = $conn->createQueryBuilder();

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where('email = ?')
    ->setParameter(0, $userInputEmail)
;

<?php 
$queryBuilder ->select('id', 'name')->from('users');

<?php

$queryBuilder
    ->insert('users')
;

$queryBuilder
    ->update('users')
;

$queryBuilder
    ->delete('users')
;

$date = new \DateTime("2011-03-05 14:00:21");
$stmt = $conn->prepare("SELECT * FROM articles WHERE publish_date > ?");
$stmt->bindValue(1, $date, "datetime");
$stmt->execute();

$statement = $conn->prepare('SELECT * FROM user');
$statement->execute();
$users = $statement->fetchAll();

$count = $conn->executeUpdate('UPDATE user SET username = ? WHERE id = ?', array('jwage', 1));
echo $count; // 1

$statement = $conn->executeQuery('SELECT * FROM user WHERE username = ?', array('jwage'));
$user = $statement->fetch();

$users = $conn->fetchAll('SELECT * FROM user');

$user = $conn->fetchArray('SELECT * FROM user WHERE username = ?', array('jwage'));

$username = $conn->fetchColumn('SELECT username FROM user WHERE id = ?', array(1), 0);

$user = $conn->fetchAssoc('SELECT * FROM user WHERE username = ?', array('jwage'));

$conn->insert('user', array('username' => 'jwage'));

$quoted = $conn->quote('value');
$quoted = $conn->quote('1234', \PDO::PARAM_INT);

$query = $conn->createQueryBuilder()
              ->select('*')
              ->from('users')
              ->orderBy('id', 'DESC')
              ->where('id = :id')
              ->setParameter('id', 1))
              ->setMaxResults(10)
              ->setFirstResult(1);
// Results
$rows = $query->execute()->fetchAll();

// $conn instanceof Doctrine\DBAL\Connection

$query = $conn->createQueryBuilder()
              ->select('COUNT(id) as count')
              ->from($table)
              ->where('id = :id')
              ->setParameter('id', 1);
$rowcount = $query->execute()->fetch();

Query Builder w/multiple joins
<?php
// $conn instanceof Doctrine\DBAL\Connection

$query = $conn->createQueryBuilder()
              ->select('U.*')
              ->from('users', 'U')
              ->leftJoin('U', 'genders', 'G', 'U.gender_id = G.id')
              ->leftJoin('U', 'houses', 'H', 'U.house_id = H.id')
              ->innerJoin('H', 'kindoms', 'K', 'H.kindom_id = K.id')
              ->where('U.id = ?')
              ->setParameter(0, 1);

/**
 * Creates a LIKE() comparison expression with the given arguments.
 *
 * @param string $x Field in string format to be inspected by LIKE() comparison.
 * @param mixed  $y Argument to be used in LIKE() comparison.
 */
public function like(string $x, $y/*, ?string $escapeChar = null */) : string
{
        return $this->comparison($x, 'LIKE', $y) .
                (func_num_args() >= 3 ? sprintf(' ESCAPE %s', func_get_arg(2)) : '');
}

$result = $queryBuilder->select('*')
        ->from($this->getTable())
        ->where(
                $queryBuilder->expr()->like('name', ':name')
        )
        ->orderBy('name', 'asc')
        ->setParameter(':name', '%' . $name . '%')
        ->execute();

$result = $queryBuilder->select('*')
        ->from($this->getTable())
        ->where(
                $queryBuilder->expr()->like('name', ':name')
        )
        ->orderBy('name', 'asc')
        ->setParameter(':name', $name . '%')
        ->execute();

$result = $queryBuilder->select('*')
        ->from($this->getTable())
        ->where(
                $queryBuilder->expr()->like('name', ':name')
        )
        ->orderBy('name', 'asc')
        ->setParameter(':name', '%' . $name)
        ->execute();

$conn->exec("CREATE TABLE users (
            userid VARCHAR PRIMARY KEY  NOT NULL ,
            password VARCHAR NOT NULL ,
            name VARCHAR,
            surname VARCHAR
            );");
$conn->exec("INSERT INTO users VALUES('user','pass','Name','Surname');");
$conn->exec("INSERT INTO users VALUES('user2','pass2','Name2','Surname2');");


private $conn;
 
public function __construct(Doctrine\DBAL\Connection $conn)
{
    $this->conn = $conn;
}
 
public function insert($tableName, array $values = [], array $types = [])
{
    $this->conn->insert($tableName, $values, $types);
}
 
public function delete($tableName, array $where = [], array $types = [])
{
    $this->conn->delete($tableName, $where, $types);
}
 
public function update($tableName, array $data, array $where = [], array $types = [])
{
    $this->conn->update($tableName, $data, $where, $types);
}
```


https://www.garybell.co.uk/doctrine-dbal-and-the-like-operator/
https://www.thedevfiles.com/2014/08/simplifying-database-interactions-with-doctrine-dbal
https://makandracards.com/oro/67274-create-a-doctrine-dbal-connection-for-another-database
https://danielmg.org/php/doctrine-dbal-cheatsheet.html 
https://www.garybell.co.uk/doctrine-dbal-and-the-like-operator/
https://www.slimframework.com/docs/v3/cookbook/database-doctrine.html
https://dzone.com/articles/yet-another-database

