## DBAL x PDO

Eu normalmente uso PDO em meus projetos PHP. Eu gosto porque é uma extensão PHP fácil de usar e compartilha a mesma interface entre todos os bancos de dados. Normalmente eu uso PostgreSQL, mas se eu mudar para mySql ou Oracle, não preciso usar funções diferentes para lidar com as conexões de banco de dados.
PHP tem um ótimo projeto chamado Doctrine2. Doctrine2 é um ORM e usa sua própria camada de abstração de banco de dados chamada DBAL. Na verdade, DBAL não é uma camada de abstração de banco de dados pura. É construído sobre o PDO. É um conjunto de classes PHP que podemos usar e que nos fornece recursos não disponíveis com PDO "puro". Se usarmos Doctrine2, estaremos usando DBAL nos bastidores, mas não precisamos usar Doctrine2 para usar DBAL. Podemos usar DBAL como uma camada de abstração de banco de dados sem qualquer ORM. Obviamente, essa camada PHP extra sobre nossa extensão PDO precisa pagar uma taxa. Vou dar uma olhada nessa taxa neste post. Vou pegar uma das minhas postagens antigas sobre PDO e farei o mesmo com DBAL para ver as diferenças de desempenho. Vamos começar:

## Exemplo em PDO
```
error_reporting(-1);
$time = microtime(TRUE);
$mem = memory_get_usage();
 
$dbh = new PDO('pgsql:dbname=mydb;host=localhost', 'gonzalo', 'password');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$dbh->beginTransaction();
 
$smtp = $dbh->prepare('INSERT INTO test.tbl1 (id, field1) values (:ID, :FIELD1)');
 
for ($i=0; $i<1000; $i++) {
    $smtp->execute(array('ID' => $i, 'FIELD1' => "field {$i}"));
}
 
$dbh->commit();
 
$stmt = $dbh->prepare('SELECT * FROM test.tbl1 limit 10000');
$stmt->execute();
 
$i=0;
while ($row = $stmt->fetch()) {
    $i++;
}
echo '<h1>PDO</h1>';
echo "<strong>{$i} </strong>";
 
print_r(array('memory' => (memory_get_usage() - $mem) / (1024 * 1024), 'seconds' => microtime(TRUE) - $time));
 
$dbh->beginTransaction();
$smtp = $dbh->prepare('delete from test.tbl1');
$smtp->execute();
$dbh->commit();
```

## Exemplo com DBAL
```
error_reporting(-1);
$time = microtime(TRUE);
$mem = memory_get_usage();
 
use Doctrine\DBAL\DriverManager;
 
$connectionParams = array(
    'dbname'   => 'mydb',
    'user'     => 'gonzalo',
    'password' => 'password',
    'host'     => 'localhost',
    'driver'   => 'pdo_pgsql',
    );
 
$dbh = DriverManager::getConnection($connectionParams);
 
$dbh->beginTransaction();
 
$smtp = $dbh->prepare('INSERT INTO test.tbl1 (id, field1) values (:ID, :FIELD1)');
 
for ($i=0; $i<1000; $i++) {
    $smtp->execute(array('ID' => $i, 'FIELD1' => "field {$i}"));
}
 
$dbh->commit();
 
$stmt = $dbh->prepare('SELECT * FROM test.tbl1 limit 10000');
$stmt->execute();
 
$i=0;
while ($row = $stmt->fetch()) {
    $i++;
}
echo '<h1>DBAL</h1>';
echo "<strong>{$i} </strong>";
 
print_r(array('memory' => (memory_get_usage() - $mem) / (1024 * 1024), 'seconds' => microtime(TRUE) - $time));
```

Como podemos ver, o DBAL é mais lento do que o PDO puro (obviamente). De qualquer forma, a maior parte do tempo extra do DBAL é o tempo que precisamos para incluir classes php (lembre-se que PDO é uma extensão PHP e não precisamos incluir nenhum arquivo). Se levarmos alguns tempos excluindo o tempo de inclusão, o uso de memória é quase o mesmo e o tempo de execução um pouco mais lento.

## Modo Transacional
```
$dbh->transactional(function($conn) {
    $smtp = $conn->prepare('INSERT INTO wf.tbl1 (id, field1) values (:ID, :FIELD1)');
 
    for ($i=0; $i<1000; $i++) {
        $smtp->execute(array('ID' => $i, 'FIELD1' => "field {$i}"));
    }
});
```

Um fechamento simples tornará o código mais conciso e fará o commit / rollback de nossa transação para nós. Na verdade, peguei emprestada essa função em meus projetos de PDO para usar essa interface. Eu amo código aberto.

## Snippet da biblioteca DBAL:
```
/**
 * Executes a function in a transaction.
 *
 * The function gets passed this Connection instance as an (optional) parameter.
 *
 * If an exception occurs during execution of the function or transaction commit,
 * the transaction is rolled back and the exception re-thrown.
 *
 * @param Closure $func The function to execute transactionally.
 */
public function transactional(Closure $func)
{
    $this->beginTransaction();
    try {
        $func($this);
        $this->commit();
    } catch (Exception $e) {
        $this->rollback();
        throw $e;
    }
}
```

## Conversão de tipos
```
$date = new \DateTime("2011-03-05 14:00:21");
$stmt = $conn->prepare("SELECT * FROM articles WHERE publish_date > ?");
$stmt->bindValue(1, $date, "datetime");
$stmt->execute();
```

## Lista de conversão de parâmetros

É um recurso legal também disponível no DBAL desde Doctrine 2.1
```
$dbh->executeQuery('SELECT * FROM wf.tbl1 WHERE id IN (?)',
    array(array(1, 2, 3, 4, 5, 6)),
    array(\Doctrine\DBAL\Connection::PARAM_INT_ARRAY));
```
Parâmetros de vinculação com cláusula IN com PDO é um pouco feio. Precisamos criar uma série de parâmetros de ligação dependendo de nossa lista para mapeá-los dentro do SQL. É possível, mas a interface DBAL é mais inteligente.

## Aninhamento de transações
```
$dbh->beginTransaction();
try {
    $dbh->beginTransaction();
    try {
        $smtp = $dbh->prepare('INSERT INTO wf.tbl1 (id, field1) values (:ID, :FIELD1)');
 
        for ($i=0; $i<1000; $i++) {
            $smtp->execute(array('ID' => $i, 'FIELD1' => "field {$i}"));
        }
 
        } catch (Exception $e) {
            $dbh->rollback(); //transaction marked for rollback only
            throw $e;
        }
    $smtp = $dbh->prepare('INSERT INTO wf.tbl1 (id, field1) values (:ID, :FIELD1)');
 
    for ($i=0; $i<1000; $i++) {
        $smtp->execute(array('ID' => $i, 'FIELD1' => "field {$i}"));
    }
 
    $dbh->commit(); // real transaction committed
} catch (Exception $e) {
    $dbh->rollback(); // transaction rollback
    throw $e;
}
```

https://gonzalo123.com/2011/07/11/database-abstraction-layers-in-php-pdo-versus-dbal/


