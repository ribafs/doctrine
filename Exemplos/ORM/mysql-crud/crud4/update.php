<?php
// update_customer.php <id> <new-name>|<new-email>|<new-ssn>
require_once "../bootstrap.php";

$id = $_REQUEST['id'];//Entre com GET a após o submit muda para POST, portanto REQUEST
$customer = $entityManager->find('Customer', $id);

if ($customer === null) {
    echo "No customer found.\n";
    exit(1);
}

$name = $customer->getName();
$email = $customer->getEmail();
$ssn = $customer->getSsn();
?>

<div><h3><b>CRUD com Doctrine<br>Atualizar</h3></b></div>
     <form method="post" action="update.php">
         <table>
            <tr><td><b>Name</td><td><input type="text" name="name" value="<?=$name?>"></td></tr>
            <tr><td><b>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
            <tr><td><b>SSN</td><td><input type="text" name="ssn" value="<?=$ssn?>"></td></tr>
            <input name="id" type="hidden" value="<?=$id?>">
             <tr><td></td><td><input name="enviar" type="submit" value="Editar">
        </table>
    </form>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ssn = $_POST['ssn'];

    $customer->setName($name);
    $customer->setEmail($email);
    $customer->setSsn($ssn);

    $entityManager->flush();

    header('location: index.php');
}
