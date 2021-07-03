<?php

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

// Insert a new user into the users table
$ret = $conn->insert('customers', array('name' => 'Pedro Brito', 'email' => 'bob@example.com', 'ssn' => '444444'));


