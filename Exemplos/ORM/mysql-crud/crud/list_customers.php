<?php
// list_customers.php
require_once "../bootstrap.php";

$customerRepository = $entityManager->getRepository('Customer');
$customers = $customerRepository->findAll();

echo 'Nome        E-mail             SSN'."\n";
foreach ($customers as $customer) {
    echo $customer->getName() . '  '.$customer->getEmail().'  '.$customer->getSsn()."\n";
}


