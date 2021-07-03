<?php
// update_customer.php <id> <new-name>|<new-email>|<new-ssn>
require_once "../bootstrap.php";

$id = $argv[1];
$name = $argv[2];
$email = $argv[3];
$ssn = $argv[4];

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
