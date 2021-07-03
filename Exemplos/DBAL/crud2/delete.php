<?php
// delete.php id
require_once "../bootstrap.php";
use Doctrine\DBAL\DriverManager;
$conn = DriverManager::getConnection($connectionParams, $config);

$id = $_GET['id'];
$conn->delete('customers', array('id' => $id));
header('location: index.php');
