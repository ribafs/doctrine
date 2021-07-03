# QueryBuilder

QueryBuilder. Ele alivia e muito o trabalho de criar querys complexas, com muitas regras e joins. 

Segurança: Prevenindo com segurança a injeção de SQL

É importante entender como o QueryBuilder/construtor de consultas funciona em termos de prevenção de injeção de SQL. Como o SQL permite expressões em quase todas as cláusulas e posições, o Doctrine QueryBuilder só pode evitar injeções de SQL para chamadas aos métodos setFirstResult () e setMaxResults ().

Todos os outros métodos não podem distinguir entre a entrada do usuário e do desenvolvedor e, portanto, estão sujeitos à possibilidade de injeção de SQL.

Para trabalhar com segurança com o QueryBuilder, você NUNCA deve passar a entrada do usuário para qualquer um dos métodos do QueryBuilder e usar o espaço reservado ? ou: sintaxe de nome em combinação com $queryBuilder->setParameter($placeholder, $value) ao invés:
```
$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where('email = ?')
    ->setParameter(0, $userInputEmail)
;

select()

$queryBuilder
    ->select('id', 'name')
    ->from('users');

$queryBuilder
    ->insert('users')
;

$queryBuilder
    ->update('users')
;

$queryBuilder
    ->delete('users')
;

$queryBuilder
    ->select('name')
    ->distinct()
    ->from('users')
;

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where('email = ?')
;

//alias de tabelas

$queryBuilder
    ->select('u.id', 'u.name')
    ->from('users', 'u')
    ->where('u.email = ?')
;

$queryBuilder
    ->select('DATE(last_login) as date', 'COUNT(id) AS users')
    ->from('users')
    ->groupBy('DATE(last_login)')
    ->having('users > 10')
;

$queryBuilder
    ->select('u.id', 'u.name', 'p.number')
    ->from('users', 'u')
    ->innerJoin('u', 'phonenumbers', 'p', 'u.id = p.user_id')

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->orderBy('username', 'ASC')
    ->addOrderBy('last_login', 'ASC NULLS FIRST')
;

//limit

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->setFirstResult(10)
    ->setMaxResults(20);

$queryBuilder
    ->insert('users')
    ->values(
        array(
            'name' => '?',
            'password' => '?'
        )
    )
    ->setParameter(0, $username)
    ->setParameter(1, $password)
;
// INSERT INTO users (name, password) VALUES (?, ?)

$queryBuilder
    ->insert('users')
    ->setValue('name', '?')
    ->setValue('password', '?')
    ->setParameter(0, $username)
    ->setParameter(1, $password)
;
// INSERT INTO users (name, password) VALUES (?, ?)

$queryBuilder
    ->insert('users')
    ->values(
        array(
            'name' => '?'
        )
    )
    ->setParameter(0, $username)
;
// INSERT INTO users (name) VALUES (?)

if ($password) {
    $queryBuilder
        ->setValue('password', '?')
        ->setParameter(1, $password)
    ;
    // INSERT INTO users (name, password) VALUES (?, ?)
}

$queryBuilder
    ->insert('users')
;
// INSERT INTO users () VALUES ()

$queryBuilder
    ->update('users', 'u')
    ->set('u.logins', 'u.logins + 1')
    ->set('u.last_login', '?')
    ->setParameter(0, $userInputLastLogin)
;

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where(
        $queryBuilder->expr()->and(
            $queryBuilder->expr()->eq('username', '?'),
            $queryBuilder->expr()->eq('email', '?')
        )
    );

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where('email = ' .  $queryBuilder->createNamedParameter($userInputEmail))
;
// SELECT id, name FROM users WHERE email = :dcValue1

$queryBuilder
    ->select('id', 'name')
    ->from('users')
    ->where('email = ' .  $queryBuilder->createPositionalParameter($userInputEmail))
;
// SELECT id, name FROM users WHERE email = ?

//Pegar produtos que tem a categoria 2
$query = $dbh->createQueryBuilder();
$query->select('p.*')
    ->from('produtos', 'p')
    ->where('p.categoria_id = :categoria')
    ->setParameter(':categoria', 2);
;
$statement = $query->execute();
$produtos = $statement->fetch();
var_dump($produtos);

//Pegar todos produtos e suas respectivas categorias
$query = $dbh->createQueryBuilder();
$query->select('p.nome as produto,c.nome as categoria')
    ->from('produtos', 'p')
    ->leftJoin('p','categorias','c','c.id = p.categoria_id');
;
$statement = $query->execute();
$produtos = $statement->fetch();
print_r($produtos);
```

O QueryBuilder facilita nosso trabalho, porque abstrai a escrita de SQL puro, não temos que escrever uma query inteira em string, podemos trabalhar de forma orientada a objetos. Ele já tem todas funções que precisamos: where, order by, joins, select, group by, froms, etc.


https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html#sql-query-builder

http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html

http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/data-retrieval-and-manipulation.html

http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html

https://blog.schoolofnet.com/substituindo-o-pdo-por-doctrine-dbal/
