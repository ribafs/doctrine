<?php
// show_customer.php <id>
require_once "../bootstrap.php";

$id = $argv[1];
$customer = $entityManager->find('Customer', $id);

if ($customer === null) {
    echo "No customer found.\n";
    exit(1);
}

echo sprintf("-%s\n", $customer->getName());
