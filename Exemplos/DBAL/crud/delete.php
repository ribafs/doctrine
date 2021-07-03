<?php

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

// Insert a new user into the users table
$conn->delete('customers', array('id' => 11));

