<?php
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

// Criar uma configuração simples e "default" do Doctrine ORM para uso pelo Annotation Mapping
// Veja que ele irá usar os arquivos da pasta src, que são responsáveis diretamente por definir cada tabela a ser criada no banco de dados
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

// Ou se você preferir use uma configuração com yaml ou XML, escolhendo um dos abeixo e comentando o acima
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);

// Parâmetros de configuração do banco

$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'testes',
);

/*
// Para usar sqlite
$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
);
*/

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

/* Veja que temos a variável $entityManager no final, ela vai ser responsável por fazer todos os tramites entre o PHP OOP e o MySql, em outras palavras ela vai ser responsável por inerir, cadastrar, requisitar e deletar dados do banco. Vou nomear este arquivo de bootstrap.php */

/*
Dá vontade de renomear este arquivo de bootstrap para config ou connection, mas devemos resistir a isso, pois é assim que a documentação oficial o chama e estariamos melhorando para nós mas complicando para outros que fossem ler nosso código. */

