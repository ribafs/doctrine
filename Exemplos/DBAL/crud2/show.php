<?php
// show_customer.php <id>
require_once "../bootstrap.php";

$sth = $conn->executeQuery("SELECT * FROM customers WHERE id = 6");

$statement = $conn->prepare("SELECT * FROM customers WHERE id = 6");
$resultSet = $statement->execute();
$rows = $resultSet->fetchAllAssociative();

$id = $argv[1];
$customer = $entityManager->find('Customer', $id);

if ($customer === null) {
    echo "No customer found.\n";
    exit(1);
}

echo sprintf("-%s\n", $customer->getName());
