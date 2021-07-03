<?php
// list_customers.php
require_once "../bootstrap.php";

// Repository auxilia com a pesquisa.
$customerRepository = $entityManager->getRepository('Customer');
$customers = $customerRepository->findAll();

echo '<h3>CRUD com Doctrine 2</h3>';
echo '<a href="add.php">Adicionar</a>';
echo '<table border="1">';
echo '<tr><td>Nome</td><td>E-mail</td><td>SSN</td><tr>';
foreach ($customers as $customer) {
    $id = $customer->getId();
    echo '<tr><td>'.$customer->getName().'</td><td>'.$customer->getEmail().'</td><td>'.$customer->getSsn().'</td>';
    ?>
    <td><a href="update.php?id=<?=$id?>">Editar</a></td>
    <td><a onclick="return confirm('Realmente excluir o cliente <?=$id?> ?')" href="delete.php?id=<?=$id?>">Excluir</td></tr>
    <?php
}
echo '</table>';

