<?php
// delete.php id
require_once "../bootstrap.php";

$id = $_GET['id'];
// get EntityManager
$customer = $entityManager->find('Customer', $id);

// OR you can get the entity itself ( will generate a query )
// $customer = $entityManager->getRepository('ProjectBundle:Customer')->find($id);

// Remove it and flush
$entityManager->remove($customer);
$entityManager->flush();

header('location: index.php');
