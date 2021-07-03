<?php
// update_customer.php <id> <new-name>|<new-email>|<new-ssn>
require_once "../bootstrap.php";

$id = $argv[1];
$newName = $argv[2];
$newEmail = $argv[3];
$newSsn = $argv[4];

$customer = $entityManager->find('Customer', $id);

if ($customer === null) {
    echo "Customer $id does not exist.\n";
    exit(1);
}

$customer->setName($newName);
$customer->setEmail($newEmail);
$customer->setSsn($newSsn);

$entityManager->flush();

echo $customer->getName()."\n";
