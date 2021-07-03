<?php
// list_customers.php
require_once "../bootstrap.php";
use Doctrine\DBAL\DriverManager;
$conn = DriverManager::getConnection($connectionParams, $config);

echo '<h3>CRUD com Doctrine 2</h3>';
echo '<a href="add.php">Adicionar</a>';
echo '<table border="1">';
echo '<tr><td>Nome</td><td>E-mail</td><td>SSN</td><tr>';
$sql = "SELECT * FROM customers";
$stmt = $conn->query($sql); // Simple, but has several drawbacks

while (($row = $stmt->fetchAssociative()) !== false) {
    $id = $row['id'];
    echo '<tr><td>'.$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['ssn'].'</td>';
    ?>
    <td><a href="update.php?id=<?=$id?>">Editar</a></td>
    <td><a onclick="return confirm('Realmente excluir o cliente <?=$id?> ?')" href="delete.php?id=<?=$id?>">Excluir</td></tr>
    <?php
}
echo '</table>';

