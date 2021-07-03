<?php

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);
$id = $_GET['id'];
$sth = $conn->executeQuery("SELECT * FROM customers WHERE id = 6");
$rows = $sth->fetchAllAssociative();

foreach($rows as $row){
    echo $row['name'].'-'.$row['email'].'-'.$row['ssn'];
}
