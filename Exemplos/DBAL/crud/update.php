<?php

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

// Insert a new user into the users table
$conn->update('customers', array('name' => 'Antônio', 'email' => 'antonio@example.com', 'ssn' => '55555'), array('id' => 12));

