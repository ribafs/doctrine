<?php

require_once '../bootstrap.php';

use Doctrine\DBAL\DriverManager;

$conn = DriverManager::getConnection($connectionParams, $config);

$sql = "SELECT * FROM customers";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

while (($row = $stmt->fetchAssociative()) !== false) {
    echo $row['name'].'-'.$row['email'].'-'.$row['ssn']."\n<br>";
}
