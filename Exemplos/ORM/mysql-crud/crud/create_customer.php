<?php
// create_customer.php <name> <email> <ssn>
require_once "../bootstrap.php";

$newCustomerName = $argv[1];
$newCustomerEmail = $argv[2];
$newCustomerSsn = $argv[3];

$customer = new Customer();
$customer->setName($newCustomerName);
$customer->setEmail($newCustomerEmail);
$customer->setSsn($newCustomerSsn);

$entityManager->persist($customer);
$entityManager->flush();

echo "Created Customer with ID " . $customer->getId() . "\n";
