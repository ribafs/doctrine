<?php
// update_customer.php <id> <new-name>|<new-email>|<new-ssn>
require_once "../bootstrap.php";

$id = 2;
$name = 'Roberto Galvão';
$email = 'galvao@gal.com';
$ssn = '8888888';

$customer = $entityManager->find('Customer', $id);

if ($customer === null) {
    echo "Customer $id does not exist.\n";
    exit(1);
}

$customer->setName($name);
$customer->setEmail($email);
$customer->setSsn($ssn);

$entityManager->flush();

echo $customer->getName()."\n";
