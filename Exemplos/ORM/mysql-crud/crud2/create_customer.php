<?php
// create_customer.php <name> <email> <ssn>
require_once "../bootstrap.php";

$name = $argv[1];
$email = $argv[2];
$ssn = $argv[3];

$cust = new Customer();
$cust->setName($name);
$cust->setEmail($email);
$cust->setSsn($ssn);

$entityManager->persist($cust);
$entityManager->flush();

echo "Created Customer with ID " . $cust->getId() . "\n";
