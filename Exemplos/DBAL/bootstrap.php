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

