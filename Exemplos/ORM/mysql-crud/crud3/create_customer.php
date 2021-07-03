<?php
// create_customer.php <name> <email> <ssn>
require_once "../bootstrap.php";

// Com informações fixas

$name = 'Roberto Queiroz';
$email = 'roberto@rob.com';
$ssn = '111222333';

$cust = new Customer();
$cust->setName($name);
$cust->setEmail($email);
$cust->setSsn($ssn);

$entityManager->persist($cust);
$entityManager->flush();

echo "Created Customer with ID " . $cust->getId() . "\n";
